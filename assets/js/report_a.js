let labels = []
document.querySelectorAll(".data").forEach((e, i, p)=>{
  labels.push($(e).attr("data-lblname"))
})

let values = []
document.querySelectorAll(".data").forEach((e, i, p)=>{
  values.push($(e).val())
})

const data = {
  labels: labels,
  datasets: [{
    label: 'Número de estudiantes por grupo',
    backgroundColor: palette('tol', values.length).map(function(hex) {
      return '#' + hex;
    }),
    borderColor: 'rgb(255, 99, 132)',
    data: values,
  }]
};

const config = {
  type: 'bar',
  data: data,
  options: {
    responsive: true,
    maintainAspectRatio: false
  }
};


let chart = new Chart(
  document.querySelector("#graph-bar"),config
)