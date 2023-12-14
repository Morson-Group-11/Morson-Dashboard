function updateView() {
    fetch('/fetchViewData.php')
        .then(response => response.json())
        .then(data => {
            console.log('Server response:', data);  // Log the server response
            if (data.departmentDataSet && data.departmentDataSet.business_development) {
                var businessDataArray = data.departmentDataSet.business_development;
                var selectedMonthData = businessDataArray.find(entry => entry.month === 12); // Replace with desired month
                console.log('Filtered data:', selectedMonthData);  // Log the filtered data

                if (selectedMonthData) {
                    document.getElementById('liveBids').innerText = selectedMonthData['live_bids'];
                    document.getElementById('totalBids').innerText = '£' + selectedMonthData['value_live_bids'];
                    document.getElementById('currentLeads').innerText = selectedMonthData['current_leads'];
                } else {
                    // Handle case where no data is available for the selected month
                    document.getElementById('liveBids').innerText = 'No data available.';
                    document.getElementById('totalBids').innerText = 'No data available.';
                    document.getElementById('currentLeads').innerText = 'No data available.';
                }
            }
            setTimeout(updateView, 30000);
        })
        .catch(error => console.error('Error:', error));
}
updateView();