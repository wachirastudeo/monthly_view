//add script pop up
add_action('wp_footer', function() {
?>
<script>
let popupTimeout; // ตัวแปรเก็บเวลาในการหน่วงเปิด Popup

function openPopup(eventElement) {
    // ถ้ากำลังหน่วงเวลาการเปิดอยู่ ให้ยกเลิก
    clearTimeout(popupTimeout);

    let overlay = document.getElementById("mec-event-overlay");
    let popup = document.getElementById("mec-event-popup");
    let content = document.getElementById("mec-popup-content");

    // ดึงข้อมูล Event จาก data attributes
    let eventTitle = eventElement.getAttribute("data-title");
    let eventDate = eventElement.getAttribute("data-date");
    let eventDescription = eventElement.getAttribute("data-description");
    let eventImage = eventElement.querySelector("img").outerHTML;

    content.innerHTML = eventImage + "<h2>" + eventTitle + "</h2>" +
        "<p class='titledate'>Date</p><p><strong class='eventDate'> " + eventDate +
        "</strong></p><p class='descriptevent'>Description</p><p class='eventDescription'>" + eventDescription + "</p>";

    // หน่วงเวลา 500ms ก่อนแสดง Popup
    popupTimeout = setTimeout(function() {
        overlay.style.display = "block"; // แสดงพื้นหลัง (Overlay)
        popup.style.transform = "translateX(0)"; // ทำให้ Popup ปรากฏ
        popup.style.display = "block"; // แสดง Popup
    }, 500); // หน่วงเวลา 500ms
}

function closePopup() {
    let overlay = document.getElementById("mec-event-overlay");
    let popup = document.getElementById("mec-event-popup");

    // ซ่อน Popup นุ่มนวล
    overlay.style.display = "none"; // ซ่อน Overlay
    popup.style.transition = "transform 0.3s ease-out, opacity 0.3s ease-out"; // เพิ่ม Transition นุ่มนวล
    popup.style.transform = "translateX(100%)"; // เลื่อน Popup ไปข้างนอก
    popup.style.opacity = "0"; // ลดความโปร่งใส Popup

    // หลังจากที่ซ่อนเสร็จแล้ว ให้ซ่อน popup จริงๆ
    setTimeout(function() {
        popup.style.display = "none";
        popup.style.opacity = "1"; // รีเซ็ตความโปร่งใส
    }, 300); // ใช้เวลาในการซ่อน 300ms
}

// คลิกที่ Overlay ให้ปิด Popup
document.getElementById("mec-event-overlay").addEventListener("click", closePopup);
</script>
<?php
});