document.addEventListener('DOMContentLoaded', function () {
    const moreButton = document.getElementById('moreButton');
    const lessButton = document.getElementById('lessButton');
    const hiddenRows = document.querySelectorAll('#specContainer .d-none');

    moreButton.addEventListener('click', function () {
        hiddenRows.forEach(row => row.classList.remove('d-none')); 
        moreButton.style.display = 'none'; 
        lessButton.style.display = 'block';
    });

    lessButton.addEventListener('click', function () {
        hiddenRows.forEach(row => row.classList.add('d-none')); 
        lessButton.style.display = 'none'; 
        moreButton.style.display = 'block'; 
    });
});
