function updateView() {
    fetch('/fetchViewData.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            return JSON.parse(data);
            if (data.departmentDataSet && data.departmentDataSet.business_development) {
                var businessDataArray = data.departmentDataSet.business_development;
                var selectedMonthData = businessDataArray.find(entry => entry.month === 12); // Replace with desired month

                if (selectedMonthData) {
                    document.getElementById('liveBids').innerText = selectedMonthData['live_bids'];
                    document.getElementById('totalBids').innerText = '£' + Number(selectedMonthData['value_live_bids']).toLocaleString();
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