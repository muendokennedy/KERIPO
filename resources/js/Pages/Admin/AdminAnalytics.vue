<script setup>
import AdminSidebar from '@/Components/app/AdminSidebar.vue'
import AdminHeader from '@/Components/app/AdminHeader.vue'
import {ref, computed, onMounted} from 'vue'
import { Link } from '@inertiajs/vue3'
import { Chart } from 'chart.js/auto'


// Chart preferences

const signupsChart = ref(null)
const salesChart = ref(null)
const profitsChart = ref(null)
const activityChart = ref(null)

const signupsTrendData = ref([
  { month: 'Jan', count: 450 },
  { month: 'Feb', count: 380 },
  { month: 'Mar', count: 320 },
  { month: 'Apr', count: 280 },
  { month: 'May', count: 590 },
  { month: 'Jun', count: 720 }
])

const salesData = ref([
  { month: 'Jan', count: 450 },
  { month: 'Feb', count: 380 },
  { month: 'Mar', count: 320 },
  { month: 'Apr', count: 280 },
  { month: 'May', count: 590 },
  { month: 'Jun', count: 720 }
])

const profitsData = ref([
  { name: 'Upcountry Plots', count: 580 },
  { name: 'Urban Plots', count: 425 },
  { name: 'Houses', count: 390 },
  { name: 'Apartments', count: 540 },
  { name: 'Others', count: 241 }
])

const activityChartData = ref({
  signups: 2154,
  acquisitions: 332,
  pending: 100
})

const renderProfitsDistributionChart = () => {
  if(!profitsChart.value) return

  const ctx = profitsChart.value.getContext('2d')

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: profitsData.value.map(profit => profit.name),
      datasets: [{
        label: 'Amount of profit',
        data: profitsData.value.map(profit => profit.count),
        backgroundColor: 'rgba(4, 46, 255, 1)',
        borderColor: 'rgba(4, 46, 255, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Amount of profit'
          }
        },
        x: {
          title: {
            display: true,
            text: 'Month'
          }
        }
      }
    }
  })
}

const renderSalesChart = () => {

  if(!salesChart.value) return
  
  const ctx = salesChart.value.getContext('2d')

      new Chart(ctx, {
        type: 'line',
        data: {
            labels: salesData.value.map(item => item.month),
            datasets: [{
                label: 'Recent Sales',
                data: salesData.value.map(item => item.count),
                fill: false,
                borderColor: 'rgba(4, 46, 255, 1)',
                tension: 0.5,
                pointBackgroundColor: 'rgba(4, 46, 255, 1)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of new sales'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            }
        }
    })
}

const renderSignsChart = () => {
    if(!signupsChart.value) return

    const ctx = signupsChart.value.getContext('2d')

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: signupsTrendData.value.map(item => item.month),
            datasets: [{
                label: 'Sign ups',
                data: signupsTrendData.value.map(item => item.count),
                fill: false,
                borderColor: 'rgba(4, 46, 255, 1)',
                tension: 0.5,
                pointBackgroundColor: 'rgba(4, 46, 255, 1)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of new sign ups'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            }
        }
    })
}

const renderActivityChart = () => {
  if(!activityChart.value) return

  const ctx = activityChart.value.getContext('2d')

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Signups', 'Acquisitions', 'Pending'],
      datasets: [{
        data: [
          activityChartData.value.signups,
          activityChartData.value.acquisitions,
          activityChartData.value.pending
        ],
        backgroundColor: [
          'rgba(16, 185, 129, 0.8)',  
          'rgba(239, 68, 68, 0.8)',    
          'rgba(249, 168, 37, 0.8)'   
        ],
        borderColor: [
          'rgba(16, 185, 129, 1)',
          'rgba(239, 68, 68, 1)',
          'rgba(249, 168, 37, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            // padding: 20,
            boxWidth: 10,
            boxHeight: 10,
            margin: 20
            // usePointStyle: true
          }
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              const label = context.label || ''
              const value = context.raw || 0

              console.log(context.dataset.data)
              console.log(context.label)
              console.log(context.raw)

              const total = context.dataset.data.reduce((a, b) => a+b, 0)
              const percentage = Math.round((value/total) * 100)

              return `${label}: ${value} (${percentage}%)`
            }
          }
        }
      }
    }
  })
}


onMounted(() => {
    setTimeout(() => {
        renderSignsChart()
        renderSalesChart()
        renderProfitsDistributionChart()
        renderActivityChart()
    }, 1000)
})

</script>
<template>
    <AdminSidebar/>
    <section class="ml-[15rem] w-[calc(100% - 15rem)] main-content min-h-screen">
    <AdminHeader/>
      <main class="bg-[#E4E7F3] pt-20 px-[3%] pb-4">
        <div class="canvas-container overflow-x-auto">
          <div class="recent-sales bg-white p-4 rounded-md w-[40rem] md:w-full">
            <h2 class="text-[rgb(4,46,255)] font-semibold text-lg sm:text-2xl py-4">Recent signups</h2>
            <div>
              <canvas ref="signupsChart" class="w-full"></canvas>
            </div>
          </div>
        </div>
        <div class="canvas-container overflow-x-auto">
          <div class="recent-sales bg-white p-4 rounded-md w-[40rem] md:w-full my-4">
            <h2 class="text-[rgb(4,46,255)] font-semibold text-lg sm:text-2xl py-4">Recent sales</h2>
            <div>
              <canvas ref="salesChart" class="w-full"></canvas>
            </div>
          </div>
        </div>
        <div class="canvas-container overflow-x-auto">
        <div class="top-sales-container flex flex-col md:flex-row my-8 w-full gap-4">
            <div class="recent-sales bg-white p-4 rounded-md w-[40rem] md:w-full">
              <h2 class="text-[#042EFF] font-semibold text-base md:text-xl">Profits per Month</h2>
              <div>
                <canvas ref="profitsChart" class="w-full"></canvas>
              </div>
            </div>
            <div class="recent-sales bg-white p-4 rounded-md w-[30rem] md:w-2/3">
              <h2 class="text-[#042EFF] font-semibold mb-6 text-base md:text-xl">Activity distribution</h2>
              <div>
                <canvas ref="activityChart" class="w-full"></canvas>
              </div>
          </div>
          </div>
        </div>
      </main>
    </section>
</template>
