let steps = {};
let stepGaps = {};
var x = $("#numberOfTouches").val();

if ((x = 1)) {
    $("#steps").append(
        `<select id="1" class="form-control tgtChange">
                                <option value=null disabled selected>Step` +
        x +
        `</option>
                                <option value="email">Email</option>
                                <option value="call">Call</option>
                                <option value="social">Social</option>
                                </select>
                                <select id="stepGap` +
        x +
        `" class="custom-select mr-sm-2 tgtChange1">
                                    <option value="1">1 day</option>
                                    <option value="2">2 day</option>
                                    <option value="3">3 day</option>
                                    <option value="4">4 day</option>
                                </select>`
    );
    $("#stepGapsLast").val(JSON.stringify(stepGaps));
    console.log("jsadh");
}

$("#numberOfTouches").change(function() {
    var x = $("#numberOfTouches").val();
    $("#steps").html("");
    for (i = 1; i <= x; i++) {
        $("#steps").append(
            `<select id=` +
            i +
            ` class="form-control tgtChange">
                                <option value=null disabled selected>Step` +
            i +
            `</option>
                                <option value="email">Email</option>
                                <option value="call">Call</option>
                                <option value="social">Social</option>
                                </select>
                                <select id="stepGap` +
            i +
            `" class="custom-select mr-sm-2 tgtChange1">
                                    <option value="1">1 day</option>
                                    <option value="2">2 day</option>
                                    <option value="3">3 day</option>
                                    <option value="4">4 day</option>
                                </select>`
        );
    }
    $(".tgtChange").change(function() {
        steps[this.id] = this.value;
        $("#stepsLast").val(JSON.stringify(steps));
        console.log(steps);
    });

    $(".tgtChange1").change(function() {
        stepGaps[this.id] = this.value;
        $("#stepGapsLast").val(JSON.stringify(stepGaps));
        for (o = 1; o <= x; o++) {
            var stepGapId = "stepGap" + o;
            stepGaps[stepGapId] = $("#" + stepGapId).val();
            console.log(stepGaps);
            $("#stepGapsLast").val(JSON.stringify(stepGaps));
        }
        console.log(stepGaps);
    });
    for (o = 1; o <= x; o++) {
        var stepGapId = "stepGap" + o;
        stepGaps[stepGapId] = $("#" + stepGapId).val();
        console.log(stepGaps);
        $("#stepGapsLast").val(JSON.stringify(stepGaps));
    }
});

$(".tgtChange").change(function() {
    steps[this.id] = this.value;
    $("#stepsLast").val(JSON.stringify(steps));
    console.log(steps);
});

$(".tgtChange1").change(function() {
    stepGaps[this.id] = this.value;
    $("#stepGapsLast").val(JSON.stringify(stepGaps));
    for (o = 1; o <= x; o++) {
        var stepGapId = "stepGap" + o;
        stepGaps[stepGapId] = $("#" + stepGapId).val();
        console.log(stepGaps);
        $("#stepGapsLast").val(JSON.stringify(stepGaps));
    }
    console.log(stepGaps);
});
for (o = 1; o <= x; o++) {
    var stepGapId = "stepGap" + o;
    stepGaps[stepGapId] = $("#" + stepGapId).val();
    console.log(stepGaps);
    $("#stepGapsLast").val(JSON.stringify(stepGaps));
}