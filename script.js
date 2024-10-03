document.getElementById('fetch-data').addEventListener('click', function() {
    fetch('api/backend.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('output').innerHTML = JSON.stringify(data);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});