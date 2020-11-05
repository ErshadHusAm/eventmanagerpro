var eventCategory = document.getElementById("chartEventCategory").getContext('2d');
var chartEventCategory = new Chart(eventCategory, {
    type: 'pie',
    data: {
        labels: ["Coporate", "Private", "Social"],
        datasets: [{
            backgroundColor: [
                "#3d8588",
                "#885c3d",
                "#d4c696"
            ],
            data: [CORPORATE_COUNT, PRIVATE_COUNT, SOCIAL_COUNT]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true
    }
});

var event_type = document.getElementById("chartEventType").getContext('2d');
var chartEventType = new Chart(event_type, {
    type: 'bar',
    data: {
        labels: ["Weeding", "Haldi", "Reception", "Birthday", "Engagment"],
        datasets: [{
            backgroundColor: [
                "#EDBB99",
                "#BA4A00",
                "#3d8588",
                "#885c3d",
                "#d4c696"
            ],
            data: [WEEDING_COUNT, HAALDI_COUNT,RECEPTION_COUNT, BIRTHDAY_COUNT, ENGAGEMENT_COUNT]
        }]
    },
    options: {
        responsive: false,
        maintainAspectRatio: false,
        scales: {
            xAxes: [{
                gridLines: {
                    offsetGridLines: true
                }
            }]
        }
    }
});
