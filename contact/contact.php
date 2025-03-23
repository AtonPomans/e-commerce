
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<body>
    <main>

        <!-- Contact Title Section -->
        <div class="container-fluid bg-light py-5">
            <div class="m-auto text-center col-md-6">
                <h1 class="h1">Contact Us</h1>
                <div>
                    <i class="fa-solid fa-phone"></i>
                    <a href="" class="h6 text-decoration-none" style="margin-right: 10px">555-555-5555</a>

                    <i class="fa-solid fa-envelope"></i>
                    <a href="" class="h6 text-decoration-none">info@company.com</a>
                </div>
                <p style="margin-top: 8px">
                    If you have any questions or concerns, fill out this form.<br>
                    We'll get back to you within 1-2 business days.
                </p>
            </div>
        </div>

        <!-- Contact Form Section -->
        <div class="container py-5">
            <div class="row py-5">
                <form action="" class="col-md-9 m-auto">
                    <div class="row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="">Name</label>
                            <input type="text" class="form-control mt-1" placeholder="Name">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="">Email</label>
                            <input type="email" class="form-control mt-1" placeholder="example@gmail.com">
                        </div>
                        <div class="mb-3">
                            <label for="">Subject</label>
                            <input type="text" class="form-control mt-1" placeholder="Subject">
                        </div>
                        <div class="mb-3">
                            <label for="">Message</label>
                            <textarea name="" id="" cols="30" rows="5" class="form-control mt-1" placeholder="Message"></textarea>
                        </div>
                        <div class="row">
                            <div class="text-center col mt-2">
                                <button class="btn btn-primary btn-md px-3">Send</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </main>
</body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

