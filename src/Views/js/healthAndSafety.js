function updateView() {
    fetch('/fetchViewData.php')
        .then(response => response.json())
        .then(data => {
            if (data.departmentDataSet && data.departmentDataSet.health_and_safety) {
                var hsDataArray = data.departmentDataSet.health_and_safety;
                var selectedMonthData = hsDataArray.find(entry => entry.month === 12); // Replace with desired month

                if (selectedMonthData) {
                    document.getElementById('totalAccidents').innerText = selectedMonthData['accidents'];
                    document.getElementById('healthSafetyBulletin').innerText = selectedMonthData['monthly_bulletin'];
                    document.getElementById('absences').innerText = selectedMonthData['absences'];
                } else {
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