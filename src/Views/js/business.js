console.log("Running business.js");
function updateBusinessData(businessData) {
    var liveBidsElement = document.getElementById('liveBids');
    console.log(liveBidsElement);
    var totalBidsElement = document.getElementById('totalBids');
    console.log(totalBidsElement);
    var currentLeadsElement = document.getElementById('currentLeads');
    console.log(currentLeadsElement);

    if (liveBidsElement) {
        liveBidsElement.innerText = businessData['live_bids'] || 'No data available.';
        console.log("liveBidsElement.innerText: " + liveBidsElement.innerText + "");
    } else {
        console.error('Element with ID liveBids not found');
    }

    if (totalBidsElement) {
        totalBidsElement.innerText = '£' + (businessData['value_live_bids'] || '0');
        console.log("totalBidsElement.innerText: " + totalBidsElement.innerText + "");
    } else {
        console.error('Element with ID totalBids not found');
    }

    if (currentLeadsElement) {
        currentLeadsElement.innerText = businessData['current_leads'] || 'No data available.';
        console.log("currentLeadsElement.innerText: " + currentLeadsElement.innerText + "");
    } else {
        console.error('Element with ID currentLeads not found');
    }
}

function updateView() {
    console.log("call check")
    if (currentViewName !== 'business') {
        console.log('Business view is no longer active. Exiting updateView.');
        return;
    }
    console.log('Fetching business data...');
    fetch('/fetchViewData.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log('Server response:', data);
            if (data.departmentDataSet && data.departmentDataSet.business_development) {
                console.log('Business development data found')
                var businessDataArray = data.departmentDataSet.business_development;
                var selectedMonthData = businessDataArray.find(entry => entry.month === 12); // Adjust month as needed
                if (selectedMonthData) {
                    console.log('Business data for the selected month found');
                    updateBusinessData(selectedMonthData);
                } else {
                    console.log('No data available for the selected month');
                }
            } else {
                console.log('No business development data found');
            }
        })
        .catch(error => {
            console.error('Error fetching and updating business data:', error);
        });
}
updateView();
