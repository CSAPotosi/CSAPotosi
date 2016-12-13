$(document).ready(function () {
    pageSetUp();
    // pie chart example
    var PieConfig = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    '7',
                    '7',
                    '6',
                    '5',
                    '10',
                ],
                backgroundColor: [
                    "#F7464A",
                    "#46BFBD",
                    "#FDB45C",
                    "#949FB1",
                    "#4D5360",
                ],
            }],
            labels: [
                "Red",
                "Green",
                "Yellow",
                "Grey",
                "Dark Grey"
            ]
        },
        options: {
            responsive: true
        }
    };

    window.onload = function () {
        window.myPie = new Chart(document.getElementById("pieChart"), PieConfig);
    };

})
