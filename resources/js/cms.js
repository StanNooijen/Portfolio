const coll = document.getElementsByClassName("collapsible");

for (let i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        const content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.display = "flex";
            // Temporarily set display to get the correct scrollHeight
            content.style.maxHeight = "none";
            const scrollHeight = content.scrollHeight + "px";
            content.style.maxHeight = "0";
            // Force reflow
            content.offsetHeight;
            content.style.maxHeight = scrollHeight;
        }
    });
}
$(document).ready(function() {
    $('#summernote').summernote({
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New','Poppins sans-serif', 'Times New Roman', 'Verdana'],
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
        ]
    });
});
