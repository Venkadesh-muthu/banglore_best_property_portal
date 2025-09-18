<div class="hero page-inner overlay" style="background-image: url('images/hero_bg_1.jpg')">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up">Contact Us</h1>

                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">
                            Contact
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                <div class="contact-info">

                    <?php if (!empty($contact)): ?>
                        <div class="address mt-2">
                            <i class="icon-room"></i>
                            <h4 class="mb-2">Location:</h4>
                            <p><?= nl2br(esc($contact['location'])) ?></p>
                        </div>
                        
                        <div class="open-hours mt-4">
                            <i class="icon-clock-o"></i>
                            <h4 class="mb-2">Open Hours:</h4>
                            <p>
                                <strong>Days:</strong> <?= esc($contact['open_days']) ?><br>
                                <strong>Hours:</strong> <?= esc($contact['open_hours']) ?>
                            </p>
                        </div>


                        <div class="email mt-4">
                            <i class="icon-envelope"></i>
                            <h4 class="mb-2">Email:</h4>
                            <p><?= esc($contact['email']) ?></p>
                        </div>

                        <div class="phone mt-4">
                            <i class="icon-phone"></i>
                            <h4 class="mb-2">Call:</h4>
                            <p><?= esc($contact['phone']) ?></p>
                        </div>
                    <?php else: ?>
                        <p>No contact information available.</p>
                    <?php endif; ?>

                </div>
            </div>

            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                <div id="contactMsg"></div>
                <!-- Contact Form -->
                <form id="contactForm">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Your Name" required />
                        </div>
                        <div class="col-6 mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" required />
                        </div>
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control" name="subject" placeholder="Subject" />
                        </div>
                        <div class="col-12 mb-3">
                            <textarea name="message" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-4">
                <div id="map" class="map"></div>
            </div>
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                <div id="uploadMsg"></div>
                <!-- Upload PDF Form -->
                <form id="uploadForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="pdfFile" class="form-label">Upload PDF File</label>
                            <input type="file" class="form-control" id="pdfFile" name="pdf-file" accept="application/pdf" required />
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">📂 Upload PDF</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.untree_co-section -->
 <script>
document.addEventListener("DOMContentLoaded", function () {
    // Contact Form
    document.getElementById("contactForm").addEventListener("submit", async function (e) {
        e.preventDefault();
        let form = e.target;
        let formData = new FormData(form);

        try {
            let res = await fetch("https://srivatech.app.n8n.cloud/webhook/9f4b4c3e-2fee-4f29-944a-9aaeba428bb1", {
                method: "POST",
                body: formData
            });

            if (res.ok) {
                document.getElementById("contactMsg").innerHTML =
                    `<div class="alert alert-success mt-3">✅ Message sent successfully!</div>`;
                form.reset();
            } else {
                document.getElementById("contactMsg").innerHTML =
                    `<div class="alert alert-danger mt-3">❌ Failed to send message. Try again.</div>`;
            }
        } catch (error) {
            document.getElementById("contactMsg").innerHTML =
                `<div class="alert alert-danger mt-3">⚠️ Error: ${error.message}</div>`;
        }
    });

    // Upload Form
    document.getElementById("uploadForm").addEventListener("submit", async function (e) {
        e.preventDefault();
        let form = e.target;
        let formData = new FormData(form);

        try {
            let res = await fetch("https://srivatech.app.n8n.cloud/webhook/upload-file", {
                method: "POST",
                body: formData
            });

            if (res.ok) {
                document.getElementById("uploadMsg").innerHTML =
                    `<div class="alert alert-success mt-3">✅ The PDF has been uploaded and your details have been successfully inserted into the Excel sheet.!</div>`;
                form.reset();
            } else {
                document.getElementById("uploadMsg").innerHTML =
                    `<div class="alert alert-danger mt-3">❌ Upload failed. Try again.</div>`;
            }
        } catch (error) {
            document.getElementById("uploadMsg").innerHTML =
                `<div class="alert alert-danger mt-3">⚠️ Error: ${error.message}</div>`;
        }
    });
});
</script>
