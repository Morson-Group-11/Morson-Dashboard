function updateBusinessData(businessData) {
    document.getElementById('liveBids').innerText = businessData['live_bids'] || 'No data available.';
    document.getElementById('totalBids').innerText = '£' + (businessData['value_live_bids'] || '0');
    document.getElementById('currentLeads').innerText = businessData['current_leads'] || 'No data available.';
}

function updateView() {
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
                var businessDataArray = data.departmentDataSet.business_development;
                var selectedMonthData = businessDataArray.find(entry => entry.month === 12); // Adjust month as needed
                if (selectedMonthData) {
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

// Schedule the function to run every 30 seconds
setInterval(updateView, 30000);

// Initial call to start the data fetch and view update process
updateView();
