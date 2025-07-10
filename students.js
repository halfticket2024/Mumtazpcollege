function handleProceed() {
  const agree = document.getElementById("agree");
  if (!agree.checked) {
    alert("कृपया निर्देशों को पढ़कर टिक करें");
  } else {
    openModal();
  }
}

function openModal() {
  document.getElementById("verifyModal").style.display = "block";
  generateCaptcha();
}

function closeModal() {
  document.getElementById("verifyModal").style.display = "none";
}

function generateCaptcha() {
  const code = Math.random().toString(36).substring(2, 8).toUpperCase();
  document.getElementById("captchaDisplay").innerText = code;
  document.getElementById("captchaCode").value = code;
}

function verifyAndProceed() {
  const reg = document.getElementById("regInput").value.trim();
  const dob = document.getElementById("dobInput").value.trim();
  const userCaptcha = document.getElementById("captchaInput").value.trim().toUpperCase();
  const actualCaptcha = document.getElementById("captchaCode").value.trim().toUpperCase();

  if (!reg || !dob || !userCaptcha) {
    alert("Please fill all fields.");
    return;
  }

  if (userCaptcha !== actualCaptcha) {
    alert("Captcha incorrect!");
    return;
  }

  fetch("https://mumtazpgcollegeclg2025.free.nf/verify.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `reg_id=${encodeURIComponent(reg)}&dob=${encodeURIComponent(dob)}`
  })
  .then(res => res.text())
  .then(data => {
    if (data.includes("form.html")) {
      window.location.href = `form.html?reg=${encodeURIComponent(reg)}`;
    } else {
      alert("Invalid Registration Number or DOB");
    }
  })
  .catch(err => {
    console.error(err);
    alert("Server error. Try again.");
  });
}
