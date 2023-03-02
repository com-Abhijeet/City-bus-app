$(document).ready(function() {

    // Initialize collapsible card functionality
    $('.collapsible').collapsible();
  
    // Initialize modal functionality
    $('.modal').modal();
  
    // Fetch bus schedules from server
    $.ajax({
      url: "get_schedules.php",
      success: function(data) {
        var schedules = JSON.parse(data);
        // Filter schedules based on route condition
        schedules = schedules.filter(function(schedule) {
          return schedule.start_point === "A" && schedule.end_point === "F";
        });
        // Render bus cards for filtered schedules
        renderBusCards(schedules);
      }
    });
  
    function renderBusCards(schedules) {
      // Get container for bus cards
      var container = $("#bus-cards");
      // Clear container
      container.empty();
      // Loop through schedules and create card for each one
      schedules.forEach(function(schedule) {
        // Create card HTML
        var card = `
          <div class="card">
            <div class="card-content">
              <span class="card-title">${schedule.name} - ${schedule.bus_no}</span>
              <p>Start: ${schedule.start_point}</p>
              <p>End: ${schedule.end_point}</p>
              <p>Bus Type: ${schedule.bus_type}</p>
              <p>Route Type: ${schedule.route_type}</p>
            </div>
            <div class="card-action">
              <a href="#modal1" class="modal-trigger book-ticket" data-schedule-id="${schedule.id}">Book Ticket</a>
            </div>
          </div>
        `;
        // Append card to container
        container.append(card);
      });
      // Initialize collapsible card functionality
      $('.collapsible').collapsible();
    }
  
    // Handle book ticket button click
    $("#bus-cards").on("click", ".book-ticket", function() {
      // Get schedule ID from data attribute
      var scheduleId = $(this).data("schedule-id");
      // Set hidden input value to schedule ID
      $("#schedule-id").val(scheduleId);
    });
  
    // Handle form submission for booking ticket
    $("#book-ticket-form").submit(function(event) {
      // Prevent default form submission
      event.preventDefault();
      // Get form data
      var formData = $(this).serialize();
      // Send form data to server via AJAX
      $.ajax({
        url: "book_ticket.php",
        method: "POST",
        data: formData,
        success: function(data) {
          // Display success message
          $("#success-message").text("Ticket booked successfully!");
          // Clear form inputs
          $("#name").val("");
          $("#email").val("");
          $("#phone").val("");
          // Close modal
          $("#modal1").modal("close");
        },
        error: function() {
          // Display error message
          $("#error-message").text("Failed to book ticket. Please try again.");
        }
      });
    });
  // Initialize Google Maps
var map = new google.maps.Map(document.getElementById("map"), {
    center: {lat: 37.7749, lng: -122.4194},
    zoom: 8
    });
    
    // Initialize geocoder
    var geocoder = new google.maps.Geocoder();
    
    // Get bus staff location from server every 2 minutes
    setInterval(function() {
    $.ajax({
    url: "get_staff_location.php",
    success: function(data) {
    // Parse bus staff location data
    var staffLocation = JSON.parse(data);
    // Loop through bus staff locations and update map markers
    staffLocation.forEach(function(location) {
    // Geocode bus staff location to an actual address
    geocoder.geocode({location: {lat: location.latitude, lng: location.longitude}}, function(results, status) {
    // If geocoding was successful
    if (status === "OK") {
    // Create map marker with address as tooltip
    var marker = new google.maps.Marker({
    position: {lat: location.latitude, lng: location.longitude},
    map: map,
    title: results[0].formatted_address
    });
    } else {
    // If geocoding was not successful, create map marker without tooltip
    var marker = new google.maps.Marker({
    position: {lat: location.latitude, lng: location.longitude},
    map: map
    });
    }
    });
    });
    }
    });
    }, 120000); // Update every 2 minutes
    
    // Initialize collapsible cards
    var coll = document.getElementsByClassName("collapsible");
    for (var i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
    content.style.display = "none";
    } else {
    content.style.display = "block";
    }
    });
    }
})