function updateView() {
    fetch('/fetchViewData.php')
        .then(response => response.json())
        .then(data => {
            if (data.departmentDataSet && data.departmentDataSet.business_development) {
                var businessDataArray = data.departmentDataSet.business_development;
                var latestBusinessData = businessDataArray[businessDataArray.length - 1]; // Get the latest data entry

                document.getElementById('liveBids').innerText = latestBusinessData['live_bids'] || 'No data available.';
                document.getElementById('totalBids').innerText = '£' + (latestBusinessData['value_live_bids'] ? Number(latestBusinessData['value_live_bids']).toLocaleString() : 'No data available.');
                document.getElementById('currentLeads').innerText = latestBusinessData['current_leads'] || 'No data available.';
            }
            setTimeout(updateView, 30000);
        })
        .catch(error => console.error('Error:', error));
}

updateView(); // Initial call to start the rotation