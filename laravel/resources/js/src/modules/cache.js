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
                let game = cursor.value.game;
                let date = game.date;
                date += ':00';
                date.replace(' ', 'T');
                date = new Date(date);

                //Delete games which already started
                if (date < new Date(Date.now())) {
                    objectStore.delete(cursor.value.id);
                } else {
                    for (let i = 0; i < gamesArr.length; i++) {
                        if (
                            gamesArr[i]['teams'] === game.teams &&
                            gamesArr[i]['bookie'] === game.bookie
                        ) {
                            gamesArr.splice(i, 1);
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

                let arrLength = gamesArr.length;
                for (let i = 0; i < arrLength; i++) {
                    let exists = oldGamesArr.findIndex(
                        (obj) => obj['teams'] == gamesArr[i]['teams']
                    );
                    let bet = oldGamesArr.findIndex(
                        (obj) => obj['bookie'] == gamesArr[i]['bookie']
                    );

                    if (exists !== -1 && bet !== -1) {
                        oldGamesArr[exists]['class'] = '';
                        updatedGamesArr.push(oldGamesArr[exists]);
                        objectStore.add({ game: oldGamesArr[exists] });
                    } else {
                        gamesArr[i]['class'] = 'bet-add-blink';
                        gamesArr[i]['delay'] = new Date(Date.now());
                        updatedGamesArr.push(gamesArr[i]);
                        objectStore.add({ game: gamesArr[i] });
                    }
                }
                resolve(updatedGamesArr);
            }
        };
    });
}
