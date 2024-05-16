const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

document.onreadystatechange = function () {
    if (document.readyState === "complete") {
        // Trang web đã tải hoàn toàn, ẩn phần loading
        $('.load-modal').style.display = "none";
    }
};

function updateLoadingProgress(percentage) {
    // Cập nhật tiến trình loading
    const progressBar = $('.loaded');
    progressBar.style.width = percentage + "%";
}

let currentProgress = 0;
const progressInterval = setInterval(() => {
    if(currentProgress < 95) currentProgress +=5;
    updateLoadingProgress(currentProgress);

    if (currentProgress >= 100) {
        // Đạt đến 100%, dừng mô phỏng và ẩn phần loading
        clearInterval(progressInterval);
        $('.load-modal').style.display = "none";
    }
}, 500);

const open_href = function (href) {
    window.location.replace(href.toString());
}
