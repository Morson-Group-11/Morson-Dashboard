function updateView() {
    fetch('/fetchViewData.php')
        .then(response => response.json())
        .then(data => {
            if (data.departmentDataSet && data.departmentDataSet.human_resources) {
                var hrData = data.departmentDataSet.human_resources;
                var latestHRData = hrData[hrData.length - 1]; // Get the latest data entry

                document.getElementById('hrBulletin').innerText = latestHRData['human_resources_bulletin'] || 'No data available.';
                document.getElementById('bankHolidays').innerText = latestHRData['bank_holiday'] || 'No data available.';
                document.getElementById('benefitAnnouncements').innerText = latestHRData['benefits_announcements'] || 'No data available.';
            }
            setTimeout(updateView, 30000);
        })
        .catch(error => console.error('Error:', error));
}

window.onload = function() {
    var savedScrollPosition = localStorage.getItem('scrollPosition');
    if (savedScrollPosition) {
        document.querySelector('footer p').scrollTop = savedScrollPosition;
    }
    updateView(); // Initial call to start the rotation
}