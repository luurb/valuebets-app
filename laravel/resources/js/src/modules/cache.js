export function dbConnectAwait(dbName) {
    return new Promise((resolve, reject) => {
        dbConnect((db) => {
            resolve(db);
        }, dbName);
    });
}

export function dbConnect(callback, dbName) {
    //let request = indexedDB.deleteDatabase('games');
    let request = indexedDB.open(dbName, 1);
    request.onerror = () => {
        console.log('Database failed to open');
    };

    request.onsuccess = () => {
        let db = request.result;
        callback(db);
    };

    request.onupgradeneeded = (e) => {
        let db = e.target.result;
        let objectStore = db.createObjectStore(dbName + '_os', {
            keyPath: 'id',
            autoIncrement: true,
        });
        objectStore.createIndex('game', 'game');
    };
}

export function addGamesToIndexedDb(games, db, dbName) {
    let transaction = db.transaction([dbName + '_os'], 'readwrite');
    let objectStore = transaction.objectStore(dbName + '_os');

    for (let game of games) {
        objectStore.add({ game: game });
        transaction.oncomplete = () => {
            //displayData(db);
        };
        transaction.onerror = () => {};
    }
}

export function displayData(db, dbName) {
    let transaction = db.transaction(dbName + '_os');
    let objectStore = transaction.objectStore(dbName + '_os');
    objectStore.openCursor().onsuccess = (e) => {
        let cursor = e.target.result;
        if (cursor) {
            let game = cursor.value.game;
            cursor.continue();
        }
    };
}

export function getGamesArr(db, dbName) {
    let transaction = db.transaction(dbName + '_os');
    let objectStore = transaction.objectStore(dbName + '_os');
    let gamesArr = [];

    return new Promise((resolve, reject) => {
        objectStore.openCursor().onsuccess = (e) => {
            let cursor = e.target.result;
            if (cursor) {
                let game = cursor.value.game;
                gamesArr.push(game);
                cursor.continue();
            }
            if (!cursor) resolve(gamesArr);
        };
    });
}

//Function delete games which are in IndexedDB from games array
//Return promise which then resolve with updated games array
export function hideGamesDbFilter(db, gamesArr, dbName) {
    let transaction = db.transaction([dbName + '_os'], 'readwrite');
    let objectStore = transaction.objectStore(dbName + '_os');
    return new Promise((resolve, reject) => {
        objectStore.openCursor().onsuccess = (e) => {
            let cursor = e.target.result;
            if (cursor) {
                let gameToHide = cursor.value.game;
                let date = gameToHide.date;
                date += ':00';
                date.replace(' ', 'T');
                date = new Date(date);

                //Delete games whose already started
                if (date < new Date(Date.now())) {
                    objectStore.delete(cursor.value.id);
                } else {
                    for (let i = 0; i < gamesArr.length; i++) {
                        let game = gamesArr[i];
                        if (
                            game['teams'] === gameToHide.teams &&
                            game['bookie'] === gameToHide.bookie &&
                            game['bet'] === gameToHide.bet
                        ) {
                            gamesArr.splice(i, 1);
                            i--;
                            break;
                        }
                    }
                }
                cursor.continue();
            }

            if (!cursor) resolve(gamesArr);
        };
    });
}

//Function updates games array and also updates games IndexedDb
//Return promise which then resolve with games Array ready to print
export function getUpdatedArr(db, gamesArr, dbName) {
    let transaction = db.transaction([dbName + '_os'], 'readwrite');
    let objectStore = transaction.objectStore(dbName + '_os');
    let oldGamesArr = [];
    let updatedGamesArr = [];

    return new Promise((resolve, reject) => {
        objectStore.openCursor().onsuccess = (e) => {
            let cursor = e.target.result;
            if (cursor) {
                oldGamesArr.push(cursor.value.game);
                cursor.continue();
            }

            if (!cursor) {
                objectStore.clear();

                /*
                | Check if new game was already printed to user.
                | This is for set correct delay, blink for new games
                | and update IDb.
                */
                for (let newGame of gamesArr) {
                    let foundInOldArr = 0;
                    for (let i = 0; i < oldGamesArr.length; i++) {
                        let oldGame = oldGamesArr[i];
                        if (
                            newGame.bookie == oldGame.bookie &&
                            newGame.teams == oldGame.teams &&
                            newGame.bet == oldGame.bet
                        ) {
                            oldGame['class'] = '';
                            updatedGamesArr.push(oldGame);
                            objectStore.add({ game: oldGame });
                            oldGamesArr.splice(i, 1);
                            i--;
                            foundInOldArr = 1;
                            break;
                        } 
                    }

                    if (!foundInOldArr) {
                        newGame['class'] = 'bet-add-blink';
                        newGame['delay'] = new Date(Date.now());
                        updatedGamesArr.push(newGame);
                        objectStore.add({ game: newGame });
                    }
                }
                resolve(updatedGamesArr);
            }
        };
    });
}
