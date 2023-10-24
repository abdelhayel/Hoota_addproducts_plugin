var currentTab = 0;

document.addEventListener("DOMContentLoaded", function (event) {
  showTab(currentTab);
});

function showTab(n) {
  var x = document.getElementsByClassName("tab");

  // Fade out the current step
  x[currentTab].style.opacity = 0;
  x[currentTab].style.pointerEvents = "none"; // Disable interaction during the transition

  setTimeout(function () {
    x[currentTab].style.display = "none"; // Hide the current step after the fade-out animation
    x[currentTab].style.opacity = 1; // Reset opacity

    currentTab = n;

    // Show the new step
    x[currentTab].style.display = "block";
    x[currentTab].style.pointerEvents = "auto"; // Re-enable interaction
  }, 300); // Adjust the delay (in milliseconds) as needed

  // Update button visibility
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }

  if (n == x.length - 1) {
    document.getElementById("nextBtn").style.display = "none";
    document.getElementById("generateBtn").style.display = "inline";
  } else {
    document.getElementById("nextBtn").style.display = "inline";
    document.getElementById("generateBtn").style.display = "none";
  }

  fixStepIndicator(n);
}

function nextPrev(n) {
  var x = document.getElementsByClassName("tab");

  if (n == 1 && !validateForm()) return false;

  x[currentTab].style.display = "none";
  currentTab += n;

  if (currentTab >= x.length) {
    document.getElementById("nextprevious").style.display = "none";
    document.getElementById("all-steps").style.display = "none";
    document.getElementById("register").style.display = "none";
    document.getElementById("text-message").style.display = "block";
  }

  showTab(currentTab);
}

function validateForm() {
  var x = document.getElementsByClassName("tab");
  var y = x[currentTab].querySelectorAll("input, select");
  var valid = true;

  y.forEach((input) => {
    if (input.value.trim() === "") {
      input.classList.add("invalid");
      valid = false;
    } else {
      input.classList.remove("invalid");
    }
  });

  if (valid) {
    document.getElementsByClassName("step")[currentTab].classList.add("finish");
  }

  return valid;
}

function fixStepIndicator(n) {
  var x = document.getElementsByClassName("step");

  for (var i = 0; i < x.length; i++) {
    x[i].classList.remove("active");
  }

  x[n].classList.add("active");
}

function generateCSV() {
  // Collect form data
  var formData = new FormData(document.getElementById("regForm"));
  console.log(formData);
  // Send form data to PHP using fetch
  fetch("generate_csv.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((result) => {
      // Handle the response from generate_csv.php in JavaScript
      if (result === "success") {
        // Success message
        window.location.href =
          "page2_traitement.php?message=Le%20fichier%20CSV%20a%20été%20généré%20avec%20succès.";
      } else {
        // Error message
        window.location.href =
          "page2_traitement.php?message=Erreur%20lors%20de%20la%20génération%20du%20CSV%20et%20du%20ZIP.";
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}



