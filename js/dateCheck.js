function validatedate(inputField) {
    alert(inputField.value);
    var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
    // Match the date format through regular expression
    if (inputField.value.match(dateformat)) {
        //inputField.focus();
        //Test which seperator is used '/' or '-'
        var opera1 = inputField.value.split('/');
        var opera2 = inputField.value.split('-');
        lopera1 = opera1.length;
        lopera2 = opera2.length;
        // Extract the string into month, date and year
        if (lopera1 > 1) {
            var pdate = inputField.value.split('/');
        } else if (lopera2 > 1) {
            var pdate = inputField.value.split('-');
        }
        var dd = parseInt(pdate[0]);
        var mm = parseInt(pdate[1]);
        var yy = parseInt(pdate[2]);
        // Create list of days of a month [assume there is no leap year by default]
        var ListofDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        if (mm == 1 || mm > 2) {
            if (dd > ListofDays[mm - 1]) {
                alert('Invalid date format Date 1!');
                //inputField.focus();
                return false;
            }
        }
        if (mm == 2) {
            var lyear = false;
            if ((!(yy % 4) && yy % 100) || !(yy % 400)) {
                lyear = true;
            }
            if ((lyear == false) && (dd >= 29)) {
                alert('Invalid date format Date 2!');
                //inputField.focus();
                return false;
            }
            if ((lyear == true) && (dd > 29)) {
                alert('Invalid date format Date 3!');
                //inputField.focus();
                return false;
            }
        }
    } else {
        alert("Invalid date format 4 !");
        //inputField.focus();
        return false;
    }
}

function validatedate_format(field) {
    //alert(isDate(field.value, "-"));
    if (field.value != "") {
        if (!isDate(field.value, "-")) {
            alert('Date Invalid');
            field.focus();
        }
    }
}

//Value parameter - required. All other parameters are optional.
function isDate(value, sepVal, dayIdx, monthIdx, yearIdx) {
    try {
        //Change the below values to determine which format of date you wish to check. It is set to dd/mm/yyyy by default.
        var DayIndex = dayIdx !== undefined ? dayIdx : 0;
        var MonthIndex = monthIdx !== undefined ? monthIdx : 1;
        var YearIndex = yearIdx !== undefined ? yearIdx : 2;
        //alert(value);
        value = value.replace(/-/g, "/").replace(/\./g, "/");
        //alert(value);
        var SplitValue = value.split("/");
        // var SplitValue = value.split(sepVal || "-");
        //alert(SplitValue[0]);
        var OK = true;
        if (!(SplitValue[DayIndex].length == 1 || SplitValue[DayIndex].length == 2)) {
            //alert("Day Index -" + SplitValue[DayIndex].length);
            OK = false;
        }
        if (OK && !(SplitValue[MonthIndex].length == 1 || SplitValue[MonthIndex].length == 2)) {
            //alert("Month Index -" + SplitValue[MonthIndex].length);
            OK = false;
        }
        if (OK && (SplitValue[YearIndex].length != 4 && SplitValue[YearIndex].length != 2)) {
            //alert("Year Index -" + SplitValue[YearIndex].length);
            OK = false;
        }
        if (OK) {
            //alert(OK);

            var Day = parseInt(SplitValue[DayIndex], 10);
            var Month = parseInt(SplitValue[MonthIndex], 10);
            var Year = parseInt(SplitValue[YearIndex], 10);
            //alert(Year);
            //if (OK = ((Year > 1900) && (Year < new Date().getFullYear()))) {
            if (Year < 100) {
                Year = 2000 + Year;

            }
            //alert(Year);
            //if (OK = ((Year > 2000) && (Year < 2099))) {
            if (OK = ((Year > 1900) && (Year <= (new Date().getFullYear() + 1)))) {
                if (OK = (Month <= 12 && Month > 0)) {

                    var LeapYear = (((Year % 4) == 0) && ((Year % 100) != 0) || ((Year % 400) == 0));

                    if (OK = Day > 0) {
                        if (Month == 2) {
                            OK = LeapYear ? Day <= 29 : Day <= 28;
                        } else {
                            if ((Month == 4) || (Month == 6) || (Month == 9) || (Month == 11)) {
                                OK = Day <= 30;
                            } else {
                                OK = Day <= 31;
                            }
                        }
                    }
                }
            }
        }
        return OK;
    } catch (e) {
        //alert("Catch");
        return false;
    }
}