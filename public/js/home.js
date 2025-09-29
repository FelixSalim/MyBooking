document.addEventListener("DOMContentLoaded", function () {
  const triggerTabList = [].slice.call(document.querySelectorAll('#bookingTabs button'))

  triggerTabList.forEach(function (triggerEl) {
    const tabTrigger = new bootstrap.Tab(triggerEl)

    triggerEl.addEventListener('click', function (event) {
      event.preventDefault()
      tabTrigger.show()
      // save active tab id to localStorage
      localStorage.setItem('activeTab', triggerEl.getAttribute('id'))
    })
  })

  // on page load, re-activate last tab
  const activeTab = localStorage.getItem('activeTab')
  if (activeTab) {
    const someTabTriggerEl = document.querySelector('#' + activeTab)
    if (someTabTriggerEl) {
      bootstrap.Tab.getOrCreateInstance(someTabTriggerEl).show()
    }
  }
})
