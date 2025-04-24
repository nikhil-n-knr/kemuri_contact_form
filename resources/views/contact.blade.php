<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
    
      
      
    </style>
</head>
<body>
    @include('layout.header')

    <main>
        <form id="contactForm">
            <h2>Contact Us</h2>

            <div class="form-group">
                <input type="text" name="name" placeholder="Name" required minlength="1" />
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required />
            </div>

            <div class="form-group">
                <input type="text" name="subject" placeholder="Subject" required />
            </div>

            <div class="form-group">
                <textarea name="message" placeholder="Message" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <select name="purpose" id="purpose" required>
                    <option value="">-- Select Purpose --</option>
                    <option value="issue">Contacting to raise an issue in website content</option>
                    <option value="connect">Contacting to get in touch with Kemuri</option>
                </select>
            </div>

            <div class="form-group hidden" id="shortDescriptionGroup">
                <textarea name="short_description" placeholder="Short Description (optional)" rows="3"></textarea>
            </div>

            <div class="form-group hidden" id="contactingFromGroup">
                <label>Contacting from (required):</label>
                <div>
                    <input type="radio" name="contacting_from" value="individual" required> I am an individual and not part of any organization<br>
                    <input type="radio" name="contacting_from" value="company" required> I am part of a company
                </div>
            </div>

            <div class="form-group hidden" id="companyNameGroup">
                <input type="text" name="company_name" placeholder="Company Name" />
            </div>

            <div class="form-group">
                <button type="submit">Send Message</button>
            </div>

            <div class="success" id="successMsg"></div>
            <div class="error" id="errorMsg"></div>
        </form>

        <div id="loader">
            <div></div>
        </div>
    </main>

    @include('layout.footer')

    <script>
        const purpose = document.getElementById('purpose');
        const shortDesc = document.getElementById('shortDescriptionGroup');
        const contactingFrom = document.getElementById('contactingFromGroup');
        const companyGroup = document.getElementById('companyNameGroup');

        purpose.addEventListener('change', function () {
            const selected = this.value;

            if (selected === 'issue') {
                shortDesc.classList.remove('hidden');
                contactingFrom.classList.remove('hidden');
            } else {
                shortDesc.classList.add('hidden');
                contactingFrom.classList.add('hidden');
                companyGroup.classList.add('hidden');
            }
        });

        const contactRadios = document.getElementsByName('contacting_from');
        contactRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === 'company') {
                    companyGroup.classList.remove('hidden');
                    companyGroup.querySelector('input').setAttribute('required', 'required');
                } else {
                    companyGroup.classList.add('hidden');
                    companyGroup.querySelector('input').removeAttribute('required');
                }
            });
        });
    </script>
    <script src="{{ asset('js/contact.js') }}"></script>
</body>
</html>