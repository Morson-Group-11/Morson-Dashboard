function updateView() {
    fetch('/fetchViewData.php')
        .then(response => response.json())
        .then(data => {
            if (data.departmentDataSet && data.departmentDataSet.commercial_and_accounts) {
                var accountsDataArray = data.departmentDataSet.commercial_and_accounts;
                var selectedMonthData = accountsDataArray.find(entry => entry.month === 12); // Replace with desired month

                if (selectedMonthData) {
                    document.getElementById('payday').innerText = 'Payday is: ' + selectedMonthData['payday'];
                    document.getElementById('payrollBulletin').innerText = selectedMonthData['payroll_bulletin'];
                    document.getElementById('bestPerformingProjects').innerText = selectedMonthData['best_performing_projects'];
                } else {
                    // Handle case where no data is available for the selected month
                    document.getElementById('payday').innerText = 'No data available.';
                    document.getElementById('payrollBulletin').innerText = 'No data available.';
                    document.getElementById('bestPerformingProjects').innerText = 'No data available.';
                }
            }
            setTimeout(updateView, 30000);
        })
        .catch(error => console.error('Error:', error));
}

updateView();