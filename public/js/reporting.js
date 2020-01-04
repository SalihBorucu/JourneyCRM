var ctx = document.getElementById("myChart");
var userNames = [];
var emailCounts = [];
var callCounts = [];

function load_chart() {
    var myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: [],
            datasets: [{
                // responsive: true,
                label: "Emails Sent",
                data: [],
                backgroundColor: [
                    "rgba(255, 99, 132, 0.2)",
                    "rgba(54, 162, 235, 0.2)",
                    "rgba(255, 206, 86, 0.2)",
                    "rgba(75, 192, 192, 0.2)",
                    "rgba(153, 102, 255, 0.2)",
                    "rgba(255, 159, 64, 0.2)"
                ],
                borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)"
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    for (i = 0; i < $("tbody tr").length; i++) {
        emailCounts.push(parseInt($("#emailCount" + i).html()));
    }
    for (i = 0; i < $("tbody tr").length; i++) {
        userNames.push($("#userName" + i).html());
    }
    myChart.data.datasets[0].data = emailCounts;
    myChart.data.labels = userNames;
    myChart.update();
}

load_chart();
$("#filter").click(function() {
    load_chart();
});

var ctx = document.getElementById("myChart1");
// var userNames = [];
// var emailCounts = [];

function load_chart1() {
    var myChart1 = new Chart(ctx, {
        type: "bar",
        data: {
            labels: [],
            datasets: [{
                // responsive: true,
                label: "Calls Executed",
                data: [],
                backgroundColor: [
                    "rgba(255, 99, 132, 0.2)",
                    "rgba(54, 162, 235, 0.2)",
                    "rgba(255, 206, 86, 0.2)",
                    "rgba(75, 192, 192, 0.2)",
                    "rgba(153, 102, 255, 0.2)",
                    "rgba(255, 159, 64, 0.2)"
                ],
                borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)"
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    for (i = 0; i < $("tbody tr").length; i++) {
        callCounts.push(parseInt($("#callCount" + i).html()));
    }
    // for (i = 0; i < $("tbody tr").length; i++) {
    //     userNames.push($("#userName" + i).html());
    // }
    myChart1.data.datasets[0].data = callCounts;
    myChart1.data.labels = userNames;
    myChart1.update();
}

load_chart1();
$("#filter").click(function() {
    load_chart1();
});