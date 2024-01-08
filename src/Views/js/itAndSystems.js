console.log("Running itAndSystems.js");
function updateParagraphs(elementId, title, data, key1, key2) {
    var element = document.getElementById(elementId);
    element.innerHTML = '<h2 style="font-size: 4em">' + title + '</h2>';

    data.forEach(function(item) {
        var p = document.createElement('p');
        p.style.fontSize = '40px';

        // Concatenate the two pieces of information
        var textContent = (item[key1] ? item[key1] : 'Unknown') + ' - ' + (item[key2] ? item[key2] : 'No data available');
        console.log('textContent: ' + textContent);
        // Check for specific keywords and change color if matched
        if ((elementId === 'softwareStatus' && textContent.toLowerCase().includes('fail')) ||
            (elementId === 'systemStatus' && textContent.toLowerCase().includes('offline'))) {
            p.style.color = 'red';
        } else if ((elementId === 'softwareStatus' && textContent.toLowerCase().includes('successful')) ||
            (elementId === 'systemStatus' && textContent.toLowerCase().includes('online'))) {
            p.style.color = 'green';
        }

        p.innerText = textContent;
        element.appendChild(p);
    });
}

// Rest of your updateView function...


function updateView() {
    console.log("Updating IT and Systems data...")
    fetch('/fetchViewData.php')
        .then(response => response.json())
        .then(data => {
            console.log('Server response: ', data);
            var itData = data.departmentDataSet.it_and_systems;
            if (itData && itData.scheduled_outages) {
                console.log('IT and Systems data found');
                document.getElementById('scheduledOutages').innerText = itData.scheduled_outages;
            } else {
                console.log('No IT and Systems data found');
                document.getElementById('scheduledOutages').innerText = 'No scheduled outages data available.';
            }

            var softwareData = data.departmentDataSet.it_and_systems_software;
            if (softwareData && softwareData.length > 0) {
                console.log('Software data found');
                updateParagraphs('softwareStatus', 'Software Build Status:', softwareData, 'software', 'build_status');
            } else {
                console.log('No software data found');
                document.getElementById('softwareStatus').innerHTML = '<h2 style="font-size: 4em">Build Status - Software</h2><p style="font-size: 40px;">No data available.</p>';
            }

            // Update IT and Systems Status
            var statusData = data.departmentDataSet.it_and_systems_status;
            if (statusData && statusData.length > 0) {
                console.log('IT and Systems status data found');
                updateParagraphs('systemStatus', 'System Status:', statusData, 'system', 'status');
            } else {
                console.log('No IT and Systems status data found');
                document.getElementById('systemStatus').innerHTML = '<h2 style="font-size: 3em">System Status</h2><p style="font-size: 40px;">No data available.</p>';
            }
        })
        .catch(error => console.error('Error:', error));
}
updateView();