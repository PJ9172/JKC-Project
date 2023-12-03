$(document).ready(function () {
    // Other code...
  
    // Add an onchange event handler to the Date of Birth input field
    $("#dob").on("change", function () {
      calculateAge();
    });
  
    // Function to calculate age based on the Date of Birth
    function calculateAge() {
      // Get the selected date from the Date of Birth input field
      var dob = new Date($("#dob").val());
  
  // Get the current date
  var currentDate = new Date();

  // Calculate the age by subtracting the birth year from the current year
  var age = currentDate.getFullYear() - dob.getFullYear();

  // Update the Age input field with the calculated age
  $("#age").val(age);
}

// Other code...
});  
// $("#dob").on("change", function () {
//     var dob = new Date($(this).val());
//     var today = new Date();
//     var age = today.getFullYear() - dob.getFullYear();
  
//     // Check if the birthday has occurred this year or not
//     if (today.getMonth() < dob.getMonth() || (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
//       age--;
//     }
  
//     // Set the calculated age in the "Age" input field
//     $("#age").val(age);
    
//     // Disable the "Age" input field to prevent manual changes
//     $("#age").prop("disabled", true);
//   });