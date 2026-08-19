document.addEventListener("DOMContentLoaded", function () {
    injectGlobalStyles();
    setupHamburgerMenu();
    setupThemeSwitcher();
    setupNotificationBanner();
    setupFAQ();
    setupModal();
    setupSlider();
    setupAssignmentPage();
    setupAttendancePage();
    setupResultPage();
});

function injectGlobalStyles() {
    const style = document.createElement("style");
    style.textContent = `
        /* Hamburger */
        .hamburger-btn{display:none;position:fixed;top:15px;left:15px;z-index:1001;
            background:#222;color:#fff;border:none;font-size:22px;padding:8px 12px;
            border-radius:6px;cursor:pointer;}
        @media (max-width:768px){
            .hamburger-btn{display:block;}
            aside.sidebar{position:fixed;left:-260px;top:0;height:100%;
                transition:left .3s ease;z-index:1000;}
            body.sidebar-open aside.sidebar{left:0;}
        }

        /* Theme toggle */
        .theme-toggle-btn{position:fixed;top:15px;right:15px;z-index:1001;
            background:#333;color:#fff;border:none;font-size:20px;padding:8px 12px;
            border-radius:50%;cursor:pointer;transition:transform .3s ease;}
        .theme-toggle-btn:hover{transform:rotate(20deg) scale(1.1);}
        body,aside.sidebar,table,fieldset,input,textarea,select,
        .card,.event,.faq-question,.faq-answer,.modal-box{
            transition:background-color .3s ease,color .3s ease,border-color .3s ease;}

        /* Notification banner */
        .notification-banner{background:linear-gradient(90deg,#4b6cb7,#182848);color:#fff;
            padding:12px 40px 12px 20px;text-align:center;position:relative;font-size:15px;
            animation:slideDown .4s ease;}
        @keyframes slideDown{from{transform:translateY(-100%);opacity:0;}
            to{transform:translateY(0);opacity:1;}}
        .notification-banner .close-banner{position:absolute;right:15px;top:50%;
            transform:translateY(-50%);background:transparent;border:none;color:#fff;
            font-size:18px;cursor:pointer;}

        /* FAQ */
        .faq-item{border:1px solid #ccc;border-radius:6px;margin-bottom:10px;overflow:hidden;}
        .faq-question{background:#f2f2f2;padding:12px 15px;cursor:pointer;font-weight:bold;
            display:flex;justify-content:space-between;align-items:center;}
        .faq-answer{max-height:0;overflow:hidden;transition:max-height .35s ease,padding .35s ease;
            padding:0 15px;background:#fff;}
        .faq-item.open .faq-answer{padding:12px 15px;}
        .faq-question .icon{transition:transform .3s ease;}
        .faq-item.open .faq-question .icon{transform:rotate(45deg);}

        /* Modal */
        .modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.55);
            z-index:2000;justify-content:center;align-items:center;}
        .modal-overlay.active{display:flex;}
        .modal-box{background:#fff;padding:25px 30px;border-radius:10px;max-width:420px;
            width:90%;position:relative;animation:popIn .3s ease;}
        @keyframes popIn{from{transform:scale(.8);opacity:0;}to{transform:scale(1);opacity:1;}}
        .modal-close{position:absolute;top:10px;right:14px;border:none;background:transparent;
            font-size:20px;cursor:pointer;}

        /* Slider */
        .slider-wrapper{position:relative;max-width:700px;margin:20px auto;overflow:hidden;
            border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,.15);}
        .slider-track{display:flex;transition:transform .5s ease-in-out;}
        .slide{min-width:100%;box-sizing:border-box;padding:30px;text-align:center;color:#fff;}
        .slider-btn{position:absolute;top:50%;transform:translateY(-50%);
            background:rgba(60, 59, 59, 0.4);color:#fff;border:none;font-size:20px;padding:6px 12px;
            cursor:pointer;border-radius:4px;}
        .slider-btn.prev{left:10px;}
        .slider-btn.next{right:10px;}
        .slider-dots{text-align:center;margin-top:8px;}
        .slider-dots span{display:inline-block;width:10px;height:10px;background:#ccc;
            border-radius:50%;margin:0 4px;cursor:pointer;}
        .slider-dots span.active{background:#4b6cb7;}
    `;
    document.head.appendChild(style);
}

function setupHamburgerMenu() {
    const sidebar = document.querySelector("aside.sidebar");
    if (!sidebar) return;

    const btn = document.createElement("button");
    btn.className = "hamburger-btn";
    btn.setAttribute("aria-label", "Toggle navigation menu");
    btn.innerHTML = "☰";
    document.body.prepend(btn);

    btn.addEventListener("click", function () {
        document.body.classList.toggle("sidebar-open");
        btn.innerHTML = document.body.classList.contains("sidebar-open") ? "✖" : "☰";
    });

    sidebar.querySelectorAll("a").forEach(function (link) {
        link.addEventListener("click", function () {
            document.body.classList.remove("sidebar-open");
            btn.innerHTML = "☰";
        });
    });
}

function setupThemeSwitcher() {
    const btn = document.createElement("button");
    btn.className = "theme-toggle-btn";
    btn.setAttribute("aria-label", "Toggle dark/light theme");
    document.body.prepend(btn);

    const DARK = {
        bg: "#162341",       // Deep Slate Background
        bg2: "#1e293b",      // Card & Sidebar Background
        bg3: "#334155",      // Input Field Background
        text: "#f8fafc",     // Off-white Text for sharp readability
        border: "#334155",   // Subtle borders
        link: "#60a5fa"
    };

    function setStyle(el, prop, value) {
        if (el) el.style.setProperty(prop, value, value ? "important" : "");
    }

    function paint(dark) {
        const bg = dark ? DARK.bg : "";
        const text = dark ? DARK.text : "";

        setStyle(document.documentElement, "background-color", bg);
        setStyle(document.body, "background-color", bg);
        setStyle(document.body, "color", text);

        document.querySelectorAll(
            ".main, .paragraph, .container, header, .maini"
        ).forEach(function (el) {
            setStyle(el, "background-color", bg);
            setStyle(el, "color", text);
        });

        const sidebar = document.querySelector("aside.sidebar");
        setStyle(sidebar, "background-color", dark ? DARK.bg2 : "");
        setStyle(sidebar, "border-color", dark ? DARK.border : "");

        document.querySelectorAll(".navbar a, .brand h1").forEach(function (el) {
            setStyle(el, "color", text);
        });

        document.querySelectorAll("table").forEach(function (el) {
            setStyle(el, "background-color", dark ? DARK.bg2 : "");
        });
        document.querySelectorAll("td, th").forEach(function (el) {
            setStyle(el, "color", text);
            setStyle(el, "border-color", dark ? DARK.border : "");
        });

        document.querySelectorAll("h1, h2, h3, h4, p, label, span, legend")
            .forEach(function (el) {
                setStyle(el, "color", text);
            });

        document.querySelectorAll("fieldset").forEach(function (el) {
            setStyle(el, "background-color", dark ? DARK.bg2 : "");
            setStyle(el, "border-color", dark ? DARK.border : "");
            setStyle(el, "color", text);
        });

        document.querySelectorAll("input, textarea, select").forEach(function (el) {
            setStyle(el, "background-color", dark ? DARK.bg3 : "");
            setStyle(el, "color", text);
            setStyle(el, "border-color", dark ? DARK.border : "");
        });

        document.querySelectorAll(
            'input[type="submit"], input[type="reset"], input[type="button"], form button'
        ).forEach(function (el) {
            setStyle(el, "background-color", dark ? DARK.bg3 : "");
            setStyle(el, "color", text);
            setStyle(el, "border-color", dark ? "#555555" : "");
        });

        document.querySelectorAll(".card, .event").forEach(function (el) {
            setStyle(el, "background-color", dark ? DARK.bg2 : "");
            setStyle(el, "color", text);
            setStyle(el, "border-color", dark ? DARK.border : "");
        });

        document.querySelectorAll(".faq-question, .faq-answer").forEach(function (el) {
            setStyle(el, "background-color", dark ? DARK.bg2 : "");
            setStyle(el, "color", text);
        });

        document.querySelectorAll(".modal-box").forEach(function (el) {
            setStyle(el, "background-color", dark ? DARK.bg2 : "");
            setStyle(el, "color", text);
        });

        document.querySelectorAll("hr").forEach(function (el) {
            setStyle(el, "border-color", dark ? DARK.border : "");
        });

        document.querySelectorAll("a").forEach(function (el) {
            if (el.classList.contains("hamburger-btn") ||
                el.classList.contains("theme-toggle-btn") ||
                el.closest(".navbar")) return;
            setStyle(el, "color", dark ? DARK.link : "");
        });
    }

    function applyTheme(theme) {
        const dark = theme === "dark";
        document.body.classList.toggle("dark-theme", dark);
        btn.innerHTML = dark ? "☀️" : "🌙";
        paint(dark);
    }

    const savedTheme = localStorage.getItem("studentHubTheme") || "light";
    applyTheme(savedTheme);

    btn.addEventListener("click", function () {
        const newTheme = document.body.classList.contains("dark-theme") ? "light" : "dark";
        applyTheme(newTheme);
        localStorage.setItem("studentHubTheme", newTheme);
    });
}

/* ---------- 3. Notification Banner ---------- */
function setupNotificationBanner() {
    if (sessionStorage.getItem("bannerDismissed") === "true") return;

    const banner = document.createElement("div");
    banner.className = "notification-banner";
    banner.innerHTML =
        "📢 New assignment deadlines updated. Check the Assignment page for details." +
        '<button class="close-banner" aria-label="Close notification">✖</button>';

    document.body.prepend(banner);

    banner.querySelector(".close-banner").addEventListener("click", function () {
        banner.remove();
        sessionStorage.setItem("bannerDismissed", "true");
    });
}

/* ---------- 4. Collapsible FAQ (accordion) ---------- */
function setupFAQ() {
    const faqItems = document.querySelectorAll(".faq-item");
    if (!faqItems.length) return;

    faqItems.forEach(function (item) {
        const question = item.querySelector(".faq-question");
        const answer = item.querySelector(".faq-answer");
        if (!question || !answer) return;

        question.addEventListener("click", function () {
            const isOpen = item.classList.contains("open");

            faqItems.forEach(function (other) {
                other.classList.remove("open");
                other.querySelector(".faq-answer").style.maxHeight = null;
            });

            if (!isOpen) {
                item.classList.add("open");
                answer.style.maxHeight = answer.scrollHeight + "px";
            }
        });
    });
}

/* ---------- 5. Modal Popup ---------- */
function setupModal() {
    const triggers = document.querySelectorAll("[data-modal-target]");
    if (!triggers.length) return;

    triggers.forEach(function (trigger) {
        trigger.addEventListener("click", function (e) {
            e.preventDefault();
            const modal = document.querySelector(trigger.dataset.modalTarget);
            if (modal) modal.classList.add("active");
        });
    });

    document.querySelectorAll(".modal-overlay").forEach(function (overlay) {
        const closeBtn = overlay.querySelector(".modal-close");
        if (closeBtn) {
            closeBtn.addEventListener("click", function () {
                overlay.classList.remove("active");
            });
        }
        overlay.addEventListener("click", function (e) {
            if (e.target === overlay) overlay.classList.remove("active");
        });
    });
}

/* ---------- 6. Image/Content Slider ---------- */
function setupSlider() {
    const wrapper = document.querySelector(".slider-wrapper");
    if (!wrapper) return;

    const track = wrapper.querySelector(".slider-track");
    const slides = wrapper.querySelectorAll(".slide");
    const dotsContainer = wrapper.querySelector(".slider-dots");
    let index = 0;
    let timer;

    slides.forEach(function (_, i) {
        const dot = document.createElement("span");
        if (i === 0) dot.classList.add("active");
        dot.addEventListener("click", function () {
            goToSlide(i);
            resetTimer();
        });
        dotsContainer.appendChild(dot);
    });

    function updateSlider() {
        track.style.transform = "translateX(-" + index * 100 + "%)";
        dotsContainer.querySelectorAll("span").forEach(function (dot, i) {
            dot.classList.toggle("active", i === index);
        });
    }

    function goToSlide(i) {
        index = (i + slides.length) % slides.length;
        updateSlider();
    }

    wrapper.querySelector(".slider-btn.prev").addEventListener("click", function () {
        goToSlide(index - 1);
        resetTimer();
    });
    wrapper.querySelector(".slider-btn.next").addEventListener("click", function () {
        goToSlide(index + 1);
        resetTimer();
    });

    function resetTimer() {
        clearInterval(timer);
        timer = setInterval(function () { goToSlide(index + 1); }, 4000);
    }
    resetTimer();
}

/* ---------- 7. Assignment Page Logic ---------- */
function setupAssignmentPage() {
    const statusDropdowns = document.querySelectorAll("table select.status");
    if (!statusDropdowns.length) return;

    statusDropdowns.forEach(function (select) {
        function updateColor() {
            select.style.color = select.value === "Submitted" ? "#00b894" : "#d63031";
            select.style.fontWeight = "bold";
        }
        
        updateColor();
        select.addEventListener("change", updateColor);
    });
}

/* ---------- 8. Attendance Page Logic ---------- */
function setupAttendancePage() {
    const attendanceTable = document.querySelector("body.attandence table");
    if (!attendanceTable) return;

    const attendanceData = [
        { present: 18, total: 20 },
        { present: 28, total: 30 },
        { present: 12, total: 15 },
        { present: 22, total: 25 },
        { present: 14, total: 15 },
        { present: 27, total: 30 },
        { present: 10, total: 12 },
        { present: 19, total: 20 },
        { present: 18, total: 20 },
        { present: 25, total: 30 },
        { present: 13, total: 15 },
        { present: 21, total: 25 }
    ];

    const rows = attendanceTable.querySelectorAll("tr");
    let dataIndex = 0;

    rows.forEach(function (row, index) {
        if (index === 0) return;

        const cells = row.querySelectorAll("td");
        if (cells.length >= 4 && attendanceData[dataIndex]) {
            const item = attendanceData[dataIndex];
            const percentage = ((item.present / item.total) * 100).toFixed(1);

            cells[2].textContent = `${item.present} / ${item.total}`;
            cells[3].textContent = `${percentage}%`;

            if (percentage < 75) {
                cells[3].style.color = "#d63031";
                cells[3].style.fontWeight = "bold";
            } else {
                cells[3].style.color = "#00b894";
                cells[3].style.fontWeight = "bold";
            }

            dataIndex++;
        }
    });

    const dateInput = document.getElementById("attendanceDate");
    if (dateInput) {
        dateInput.value = new Date().toISOString().split("T")[0];
    }
}

/* ---------- 9. Updated Result Page Logic ---------- */
function setupResultPage() {
    const resultTable = document.querySelector("body.result table, .result-table");
    if (!resultTable) return;

    const rows = resultTable.querySelectorAll("tbody tr");

    rows.forEach(function (row) {
        const marksCell = row.querySelector(".marks");
        const gradeCell = row.querySelector(".grade");
        const statusCell = row.querySelector(".status");

        // Works both with structured class names or standard td columns
        if (marksCell && gradeCell && statusCell) {
            const mark = parseFloat(marksCell.textContent);

            if (!isNaN(mark)) {
                let grade = "F";
                let status = "Fail";
                let color = "#d63031";

                if (mark >= 90) {
                    grade = "A+"; status = "Pass"; color = "#00b894";
                } else if (mark >= 80) {
                    grade = "A"; status = "Pass"; color = "#00b894";
                } else if (mark >= 70) {
                    grade = "B"; status = "Pass"; color = "#0984e3";
                } else if (mark >= 50) {
                    grade = "C"; status = "Pass"; color = "#e17055";
                } else if (mark >= 35) {
                    grade = "D"; status = "Pass"; color = "#fdcb6e";
                }

                gradeCell.textContent = grade;
                gradeCell.style.color = color;
                gradeCell.style.fontWeight = "bold";

                statusCell.textContent = status;
                statusCell.style.color = color;
                statusCell.style.fontWeight = "bold";
                
                marksCell.style.color = color;
                marksCell.style.fontWeight = "bold";
            }
        } else {
            // Fallback for simple table structures
            const cells = row.querySelectorAll("td");
            if (cells.length > 2) {
                const mark = parseFloat(cells[2].textContent);
                if (!isNaN(mark)) {
                    cells[2].style.color = mark >= 80 ? "#00b894" : (mark >= 50 ? "#0984e3" : "#d63031");
                    cells[2].style.fontWeight = "bold";
                }
            }
        }
    });
}

/* ---------- Result Page Logic ---------- */
function setupResultPage() {
    // Result table sodho
    const resultRows = document.querySelectorAll(".result-table tbody tr, body.result table tbody tr");
    if (!resultRows.length) return;

    resultRows.forEach(function (row) {
        const marksCell = row.querySelector(".marks");
        const gradeCell = row.querySelector(".grade");
        const statusCell = row.querySelector(".status");

        // Jo class names .marks, .grade, .status HTML ma hoy
        if (marksCell && gradeCell && statusCell) {
            const mark = parseFloat(marksCell.textContent);

            if (!isNaN(mark)) {
                let grade = "F";
                let status = "Fail";
                let color = "#ef4444"; // Red for Fail

                // Grade Rule
                if (mark >= 90) {
                    grade = "A+"; status = "Pass"; color = "#10b981"; // Green
                } else if (mark >= 80) {
                    grade = "A"; status = "Pass"; color = "#10b981";
                } else if (mark >= 70) {
                    grade = "B"; status = "Pass"; color = "#3b82f6"; // Blue
                } else if (mark >= 50) {
                    grade = "C"; status = "Pass"; color = "#f97316"; // Orange
                } else if (mark >= 35) {
                    grade = "D"; status = "Pass"; color = "#eab308"; // Yellow
                }

                // Dynamic Values set karo
                gradeCell.textContent = grade;
                gradeCell.style.color = color;
                gradeCell.style.fontWeight = "bold";

                statusCell.textContent = status;
                statusCell.style.color = color;
                statusCell.style.fontWeight = "bold";

                marksCell.style.color = color;
                marksCell.style.fontWeight = "bold";
            }
        }
    });
}