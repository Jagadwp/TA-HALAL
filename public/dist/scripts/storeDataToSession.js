const storeDataToSession = (btn = document.getElementById('right-btn')) => {
    btn.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default form submission

        let data = fillData();
        let mainActivityData = data.mainActivityData;
        let subActivityData = data.subActivityData;

        let mergedData = mergeWithExistingData(mainActivityData, subActivityData);
        console.log('mergedData: ', mergedData);

        let fixedMainActivityData = mergedData.mainActivityData;
        let fixedSubActivityData = mergedData.subActivityData;

        // Store the subActivityData object in session storage with the key 'data-log'
        sessionStorage.setItem('main-activity', JSON.stringify(fixedMainActivityData));
        sessionStorage.setItem('sub-activity', JSON.stringify(fixedSubActivityData));
    });
};

const fillData = () => {
    // Initialize an empty object to store the form data
    let mainActivityData = [];
    let subActivityData = [];
    let UUIDs = [];

    // Fill mainActivityData
    let mainActivityElems = document.querySelectorAll('.main-activity');

    // Fill UUIDs
    for (let i = 0; i < mainActivityElems.length; i++) {
        UUIDs.push(generateUUID());
    };
    console.log('UUIDs:', UUIDs);

    mainActivityElems.forEach(function (elem, index) {
        // Use an object to store the label and value of each main-activity item
        let dataPos = elem.getAttribute('data-pos') || '0';
        let pos = parseInt(dataPos, 10);

        let mainActivityItem = {};
        mainActivityItem.code = UUIDs[pos];
        mainActivityItem.label = elem.getAttribute('data-label');
        mainActivityItem.value = elem.getAttribute('data-value');
        mainActivityItem.timestamp = getDateTime();

        // Push the main-activity item object to the mainActivityData array
        if (mainActivityItem.value != '') {
            mainActivityData.push(mainActivityItem);
        };
    });

    // Fill subActivityData. Loop through each input element with class 'sub-activity'
    let subActivityElems = document.querySelectorAll('.sub-activity');
    subActivityElems.forEach(function (elem, index) {
        // Use an object to store the label and value of each sub-activity item
        let dataPos = elem.getAttribute('data-pos') || '0';
        let pos = parseInt(dataPos, 10);

        let subActivityItem = {};
        subActivityItem.code = UUIDs[pos];
        subActivityItem.label = elem.getAttribute('data-label');
        subActivityItem.value = elem.value;

        // Push the sub-activity item object to the subActivityData array
        if (subActivityItem.value != '') {
            subActivityData.push(subActivityItem);
        };
    });

    return { mainActivityData, subActivityData };
};

const mergeWithExistingData = (mainActivityData, subActivityData) => {
    // Retrieve the existing main & sub activity data from session storage
    let existingMainData = sessionStorage.getItem('main-activity');
    let existingSubData = sessionStorage.getItem('sub-activity');

    // Merge the existing main activity data and the new main activity data
    if (existingMainData) {
        let parsedData = JSON.parse(existingMainData);
        mainActivityData = [...parsedData, ...mainActivityData];
    }
    if (existingSubData) {
        let parsedData = JSON.parse(existingSubData);
        subActivityData = [...parsedData, ...subActivityData];
    }

    return { mainActivityData, subActivityData };
};

const getDateTime = () => {
    const now = new Date();
    const datetime = now.toISOString().slice(0, 19).replace('T', ' ');

    return datetime;
};

const generateUUID = () => {
    let d = new Date().getTime();
    if (typeof performance !== 'undefined' && typeof performance.now === 'function') {
        d += performance.now();
    }
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
        const r = (d + Math.random() * 16) % 16 | 0;
        d = Math.floor(d / 16);
        return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
};