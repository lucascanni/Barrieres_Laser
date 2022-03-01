var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: lesDates,
        datasets:
            [{
                data: lesMesures,
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            }]
        },
    options:
    {
        scales: {
        yAxes:
        [{
            ticks: {
                beginAtZero: false
            }
        }]
    },
    legend:
    {
        display: false
    }
    }
});