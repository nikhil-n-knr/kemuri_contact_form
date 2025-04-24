document.getElementById('contactForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const loader = document.getElementById('loader');
    const successMsg = document.getElementById('successMsg');
    const errorMsg = document.getElementById('errorMsg');

    // Show loader and clear messages
    loader.style.display = 'flex';
    successMsg.style.display = 'none';
    errorMsg.style.display = 'none';

    successMsg.textContent = '';
    errorMsg.textContent = '';

    try {
        const res = await fetch('/api/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify(data)
        });

        const result = await res.json();

        if (res.ok) {
            successMsg.textContent = result.message;
            successMsg.classList.add('visible');
            successMsg.style.display = 'block';
            form.reset();

            setTimeout(() => {
                successMsg.style.display = 'none';
                successMsg.classList.remove('visible');
            }, 10000); // 10 seconds
        } else {
            throw result;
        }
    } catch (err) {
        errorMsg.textContent = err.message || 'Something went wrong';
        errorMsg.classList.add('visible');
        errorMsg.style.display = 'block';

        setTimeout(() => {
            errorMsg.style.display = 'none';
            errorMsg.classList.remove('visible');
        }, 10000); // 10 seconds
    } finally {
        loader.style.display = 'none'; // Hide loader
    }
});
