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
          text: chart// + " Watts"
        }
      }
    });
  });
}

console.log(window.location.pathname);

if(window.location.pathname == "/tstat/index.php"){
  getData("../data/tstatCurrent.json", "Current");
  getData("../data/tstatTotal.json", "Total");
  setTimeout('getData("../data/tstatCurrent.json", "Current");', 30000);
  setTimeout('getData("../data/tstatTotal.json", "Total");', 30000);
} else if(window.location.pathname == "/lighting/index.php"){
  getData("../data/lightsCurrent.json", "Current");
  getData("../data/lightsTotal.json", "Total");
  setTimeout('getData("../data/lightsCurrent.json", "Current");', 30000);
  setTimeout('getData("../data/lightsTotal.json", "Total");', 30000);
} else {
  getData("../data/current.json", "Current");
  getData("../data/total.json", "Total");
  setTimeout('getData("../data/current.json", "Current");', 30000);
  setTimeout('getData("../data/total.json", "Total");', 30000);
}

/*getData("../data/current.json", "Current");
getData("../data/total.json", "Total");
setTimeout('getData("../data/current.json", "Current");', 30000);
setTimeout('getData("../data/total.json", "Total");', 30000);*/