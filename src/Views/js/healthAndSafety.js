console.log("Running healthAndSafety.js");
function updateView() {
    console.log("Updating health and safety data...")
    fetch('/fetchViewData.php')
        .then(response => response.json())
        .then(data => {
            console.log('Server response: ', data);
            if (data.departmentDataSet && data.departmentDataSet.health_and_safety) {
                var hsDataArray = data.departmentDataSet.health_and_safety;
                var selectedMonthData = hsDataArray.find(entry => entry.month === 12); // Replace with desired month

                if (selectedMonthData) {
                    console.log('Health and safety data for the selected month found');
                    document.getElementById('totalAccidents').innerText = selectedMonthData['accidents'];
                    document.getElementById('healthSafetyBulletin').innerText = selectedMonthData['monthly_bulletin'];
                    document.getElementById('absences').innerText = selectedMonthData['absences'];
                } else {
                    console.log('No data available for the selected month');
                    // Handle case where no data is available for the selected month
                    document.getElementById('totalAccidents').innerText = 'No data available.';
                    document.getElementById('healthSafetyBulletin').innerText = 'No data available.';
                    document.getElementById('absences').innerText = 'No data available.';
                }
            }
            setTimeout(updateView, 30000);
        })
        .catch(error => console.error('Error:', error));
}

updateView();