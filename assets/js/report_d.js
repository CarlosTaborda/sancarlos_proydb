let labels = []
document.querySelectorAll(".data-lbl").forEach((e, i, p)=>{
  labels.push($(e).text())
})

let values = []
document.querySelectorAll(".data-vl").forEach((e, i, p)=>{
  values.push($(e).text())
})


const data = {
  labels: labels,
  datasets: [{
    label: 'Número de estudiantes por grupo',
    data: values,
    backgroundColor: palette('tol', values.length).map(function(hex) {
      return '#' + hex;
    })
  }]
};

const config = {
  type: 'doughnut',
  data: data,
  options: {
    responsive: true,
    maintainAspectRatio: false,
    
  }
};


let chart = new Chart(
  document.querySelector("#pie-bar"),config
)