//
let volumeLv = 0.01
$("#seatChart").toggle()

// Blacklist / whitelist btn
let blacklist = false
let whitelist = true
let filterMode = whitelist
let $blackListBtn = $("#blacklistBtn");
$blackListBtn.on('click', '#white', function () {
    $("#white").attr("id", "black").text('Whitelist');
    filterMode = whitelist
    $(".seat").css("background-color", "white")
    filter = []
});

$blackListBtn.on('click', '#black', function () {
    $("#black").attr("id", "white").text('Blacklist');
    filterMode = blacklist
    $(".seat").css("background-color", "var(--green)")
    filter = [...Array(window.amount + 1).keys()]
    filter.splice(0, 1)
    filter = filter.map(function(e){
        return e.toString()
    });
});


// Go to seatChart
let goToSeatChart = $("#goToSeatChart")
goToSeatChart.click(function () {
    let height = $("#seatHeight").val()
    let width = $("#seatWidth").val()
    if (height && width) {
        $("#propChooser").toggle(10)
        $("#seatChart").toggle(10)
        let seat = $("#seatChart .inner .left")
        seat.css("grid-template-columns", "repeat(" + width +", 1fr)")
        let amount = height * width
        window.amount = amount
        for (let i = 1; i < amount + 1; i++) {
            seat.append("<div id='" + i + "' class='seat flexbox'>" + i +"</div>")
        }
    }
})


// Max input 16
let number = $(".number")
number.keyup(function () {
    $(this).each(function () {
        if ($(this).val() > 16) $(this).val(16)
    })
})


// Filters on .number
number.keydown(function () {
    return event.keyCode !== 69
})
$(document).ready(function() {
    $(".number").inputFilter(function(value) {
        if (event.keyCode !== 69) {
            return /^\d*$/.test(value);    // Allow digits only, using a RegExp
        }
    });
});
(function($) {
    $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    };
}(jQuery));


// Pick seats
let filter = []
let seatHis = []
let colors = ['218, 44, 77', '253, 126, 20', '248, 171, 55', '40, 167, 69', '36, 227, 58', '32, 201, 151', '23, 162, 184', '0, 123, 255', '102, 16, 242', '111, 66, 193', '232, 62, 140']

$("body").on("click", ".seat", function () {
        if (filter.indexOf(this.id) === -1) {
            $(this).css("background-color", "var(--green)")
            filter.push($(this)[0].id)
            filter.sort()
            console.log(filter)
        }
        else {
            $(this).css("background-color", "var(--white)")
            filter.splice(filter.indexOf(this.id), 1)
            console.log(filter)
        }
})
start = $("#start")
start.click(function () {
    let howMany = $("#howMany").val()
    if (howMany > filter.length) {
        //alert("You have to chose more or an equal amount of participants as there are people who are gonna win!")
        alert("\"How many?\" can only be an equal amount or lower to the participants you've chosen!")
        // Better wording perhaps? ^
        return
    }
    if (howMany) {
        getMusic("animation", function (music) {
            $(".seat").css("background-color", "var(--white)")
            let audio = new Audio(music)
            $(audio).on("playing", async function () {
                let playing = true
                while (playing) {
                    for (let i = howMany; i !== 0; i--) {
                        if (!playing) break
                        let num = getRndInt(0, filter.length)
                        let seat = filter[num]
                        $("#" + seat).css({backgroundColor: 'rgb(' + colors[(Math.random() * colors.length) | 0] + ')'})
                    }
                    await sleep(250)
                    $(".seat").css({backgroundColor: "var(--white)"})
                    $(audio).on("ended", function () {
                        playing = false
                    })
                }
            })
            $(audio).on("ended", async function () {
                $(".seat").css("background-color", "var(--white)")
                getMusic("reveal", function (music) {
                    let audio = new Audio(music)
                    $(audio).on("ended", function () {
                        bgMusic.play()
                    })
                    audio.volume = volumeLv
                    audio.play()
                })
                await sleep(1000)
                for (let i = howMany; i !== 0; i--) {
                    let num = getRndInt(0, filter.length)
                    let seat = filter[num]
                    if (seatHis.includes(seat)) {
                        i ++
                        continue
                    }
                    seatHis.push(seat)
                    $("#" + seat).css("background-color", "var(--green)")
                }
                console.log(seatHis)
                seatHis = []
            })
            bgMusic.pause()
            audio.volume = volumeLv
            audio.play()
        })
    }
    bgMusic.addEventListener('ended', function() {
        this.currentTime = 0;
        this.play();
    }, false);
})


// Play music
function getMusic(type, callback) {
    $.post(
        'audio/getRandomFile.php?type=' + type,
        function(result){
            if (callback) {
                callback(("audio/" + type + "/" + result))
            }
            let music = ("audio/" + type + "/" + result)
        },
        'json'
    );
}
let bgMusic = new Audio("audio/bg/-Wii_Shop_Channel_Main_Theme_HQ.mp3")
//let bgMusic = new Audio("audio/bg/bensound-jazzyfrenchy.mp3")
if (bgMusic.src === "http://localhost/seatPicker/audio/bg/bensound-jazzyfrenchy.mp3") {
    $("#source").append("Background music: www.bensound.com")
}
if (!played) {
    var played = true
    $(document).click(function () {
        bgMusic.volume = volumeLv
        bgMusic.play()
        bgMusic.loop = true
    })
}

function playMusic(type) {
    getMusic(type, function (music) {
        let audio = new Audio(music)
        $(audio).on("ended", function () {
        })
        audio.play()
    })
}


// Easter egg
let easterEgg = $("#easterEgg")
let eBtn = $("#easterEgg button")
let eVideo = $("#easterEgg video")
eVideo.toggle()
eBtn.click(async function () {
    await sleep(500)
    await bgMusic.pause()
    await eVideo.toggle()
    if (!eVideo.is("display:none")) alert("lol")
})


// Random int
function getRndInt(min, max) {
    return Math.floor(Math.random() * (max - min) ) + min;
}
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function alert(message) {
    let alertBox = $("#alert")
    if (!alertBox.length) {
        $.get("alert.html", function (content) {
            $("main").append(content)
            $("#alertMsg").append(message)
        })
    }
    else {
        $("#alertMsg").append(message)
        alertBox.show()
    }
}
function hideAlert() {
    $("#alert").hide()
    $("#alertMsg").empty()
}