// Validate form submission
function validateForm() {
    let companyName = document.getElementById("companyName").value;
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let description = document.getElementById("description").value;
    let certifications = document.getElementById("certifications").files;
    let products = document.getElementById("products").files;

    if (!companyName || !email || !phone || !description || certifications.length === 0 || products.length === 0) {
        document.getElementById("message").innerHTML = "<span style='color: red;'>Please fill out all fields and upload at least one certification and one product image.</span>";
        return false;
    }

    document.getElementById("message").innerHTML = "<span style='color: green;'>Registration successful! We will review your submission and get back to you.</span>";
    return false; // Prevent actual form submission for demo purposes
}
