function getData(url, chart){
  fetch(url)
  .then(response => response.json())
  .then(data => {

    let xValues = [];
    let yValues = [];
    console.log(data);
    for (let key in data) {
       xValues.push(key);
       yValues.push(data[key]);
    }
    
    var barColors = ["red", "green","blue","orange","brown"];

    new Chart(chart, {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {  
        scales: {
          y: {
            beginAtZero: true
          }
        },        
        legend: {
          display: false          
        },
        title: {
          display: true,
          text: chart + " Watts"
        }
      }
    });
  });
}

getData("../data/current.json", "Current");
getData("../data/total.json", "Total");
setTimeout('getData("../data/current.json", "Current");', 30000);
setTimeout('getData("../data/total.json", "Total");', 30000);