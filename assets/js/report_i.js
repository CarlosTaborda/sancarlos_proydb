document.querySelectorAll(".char-info").forEach((e, i, p)=>{
  debugger
  let labels = ["Estudiantes perdiendo el año ","Estudiantes ganando el año "];
  let values = [
    $(e).attr("data-perd_students"),
    parseInt($(e).attr("data-total_students")) - parseInt($(e).attr("data-perd_students"))
  ];
  let color = [ "#990000", "#38761d" ];

  let data = {
    labels: labels,
    datasets: [{
      label: 'Número de estudiantes por grupo',
      data: values,
      backgroundColor: color
    }]
  };


  const config = {
    type: 'pie',
    data: data,
    options: {
      //responsive: true,
      maintainAspectRatio: false,
      
    }
  };

  new Chart(
    e.children[1],config
  )


});


