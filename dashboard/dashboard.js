const search = document.querySelector('.search')
const search_affiche = document.querySelector('.search_icon')
search_affiche.addEventListener('click', () => {
    search.classList.toggle('active')
})
const news = document.querySelector('.new')
const notification = document.querySelector('.notification')
notification.addEventListener('click', () => {
    news.classList.toggle('active')
})

const sidebar = document.querySelector(".side")
const opens = document.querySelector('.open')
const closes = document.querySelector('.close')
opens.addEventListener('click', () => {
    sidebar.classList.toggle('menu')
})
closes.addEventListener('click', () => {
    sidebar.classList.remove('menu')
})



const delet_user = document.querySelectorAll(".delet_user")
const freelancer = document.querySelectorAll(".freelancer")
for (let i = 0; i < delet_user.length; i++) {
    delet_user[i].addEventListener('click', () => {
        freelancer[i].style.display = 'none'
        Swal.fire(
            'Deleted successfully'
        )
    })
}
const accept_task = document.querySelectorAll(".accept_task")
for (let i = 0; i < accept_task.length; i++) {
    accept_task[i].addEventListener('click', () => {
        freelancer[i].style.display = 'none'
        Swal.fire(
            'Order is accepted!',
            '',
            'success'
          )
    })
}

// edit
var options = {
    chart: {
      height: 350,
      type: "line",
      stacked: false
    },
    dataLabels: {
      enabled: false
    },
    colors: ["#FF1654", "#247BA0"],
    series: [
      {
        name: "Series A",
        data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
      },
      {
        name: "Series B",
        data: [20, 29, 37, 36, 44, 45, 50, 58]
      }
    ],
    stroke: {
      width: [4, 4]
    },
    plotOptions: {
      bar: {
        columnWidth: "20%"
      }
    },
    xaxis: {
      categories: [2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016]
    },
    yaxis: [
      {
        axisTicks: {
          show: true
        },
        axisBorder: {
          show: true,
          color: "#FF1654"
        },
        labels: {
          style: {
            colors: "#FF1654"
          }
        },
        title: {
          text: "Series A",
          style: {
            color: "#FF1654"
          }
        }
      },
      {
        opposite: true,
        axisTicks: {
          show: true
        },
        axisBorder: {
          show: true,
          color: "#247BA0"
        },
        labels: {
          style: {
            colors: "#247BA0"
          }
        },
        title: {
          text: "Series B",
          style: {
            color: "#247BA0"
          }
        }
      }
    ],
    tooltip: {
      shared: false,
      intersect: true,
      x: {
        show: false
      }
    },
    legend: {
      horizontalAlign: "left",
      offsetX: 40
    }
  };
  
  var chart = new ApexCharts(document.querySelector("#chart"), options);
  
  chart.render();
  