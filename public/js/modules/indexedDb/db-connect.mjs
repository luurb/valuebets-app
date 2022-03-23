function dbConnectAwait(dbName) {
    return new Promise((resolve, reject) => {
        dbConnect(db => {
            resolve(db);
        }, dbName);
    });
}

function dbConnect(callback, dbName) {
    //let request = indexedDB.deleteDatabase('games');
    let request = indexedDB.open(dbName, 1);
    request.onerror = () => {
        console.log('Database failed to open');
    };

    request.onsuccess = () => {
       let db = request.result;
       callback(db);
    };

    request.onupgradeneeded = e => {
        let db = e.target.result;
        let objectStore = db.createObjectStore(dbName + '_os', 
        {keyPath: 'id', autoIncrement: true});
        objectStore.createIndex('game', 'game');
    };
}

export {dbConnect, dbConnectAwait};