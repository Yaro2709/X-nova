function number_format(number, decimals) {
        dec_point = ',';
        thousands_sep = '.';
        var exponent = "";
        var numberstr = number.toString();
        var eindex = numberstr.indexOf("e");
        if (eindex > -1) {
                exponent = numberstr.substring(eindex);
                number = parseFloat(numberstr.substring(0, eindex));
        }
        var sign = number < 0 ? "-" : "";
        var integer = number;
        var fractional = number.toString().substring(integer.length + sign.length);
        dec_point = dec_point != null ? dec_point : ".";
        fractional = decimals != null && decimals > 0 || fractional.length > 1 ? (dec_point + fractional.substring(1)) : "";
        if (decimals != null && decimals > 0) {
                for (i = fractional.length - 1, z = decimals; i < z; ++i) 
                        fractional += "0";
        }
        thousands_sep = (thousands_sep != dec_point || fractional.length == 0) ? thousands_sep : null;
        if (thousands_sep != null && thousands_sep != "") {
                for (i = integer.length - 3; i > 0; i -= 3) 
                        integer = integer.substring(0, i) + thousands_sep + integer.substring(i);
        }
        return sign + integer + fractional + exponent;
}
function NumberGetHumanReadable(value) {
        return number_format(removeE(Math.floor(value)), 0);
}
function removeE(Number) {
        Number = String(Number);
        if (Number.search(/e\+/) == -1) 
                return Number;
        var e = parseInt(Number.replace(/\S+.?e\+/g, ''));
        if (isNaN(e) || e == 0) 
                return Number;
        else if ($.browser.webkit || $.browser.msie) 
                return parseFloat(Number).toPrecision(Math.min(e + 1, 21));
        else 
                return parseFloat(Number).toPrecision(e + 1);
}
var days = new Array('Sun', 'Mon', 'Tus', 'Wed', 'Thu', 'Fri', 'Sat');
var months = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
function getFormatedDate(timestamp, format) {
        var currTime = new Date();
        currTime.setTime(timestamp);
        str = format;
        str = str.replace('[d]', dezInt(currTime.getDate(), 2));
        str = str.replace('[D]', days[currTime.getDay()]);
        str = str.replace('[m]', dezInt(currTime.getMonth() + 1, 2));
        str = str.replace('[M]', months[currTime.getMonth()]);
        str = str.replace('[j]', parseInt(currTime.getDate()));
        str = str.replace('[Y]', currTime.getFullYear());
        str = str.replace('[y]', currTime.getFullYear().toString().substr(2, 4));
        str = str.replace('[G]', currTime.getHours());
        str = str.replace('[H]', dezInt(currTime.getHours(), 2));
        str = str.replace('[i]', dezInt(currTime.getMinutes(), 2));
        str = str.replace('[s]', dezInt(currTime.getSeconds(), 2));
        return str;
}
function dezInt(num, size, prefix) {
        prefix = (prefix) ? prefix : "0";
        var minus = (num < 0) ? "-" : "", 
        result = (prefix == "0") ? minus : "";
        num = Math.abs(parseInt(num, 10));
        size -= ("" + num).length;
        for (var i = 1; i <= size; i++) {
                result += "" + prefix;
        }
        result += ((prefix != "0") ? minus : "") + num;
        return result;
}
function getFormatedTime(time) {
        hours = Math.floor(time / 3600);
        timeleft = time % 3600;
        minutes = Math.floor(timeleft / 60);
        timeleft = timeleft % 60;
        seconds = timeleft;
        return dezInt(hours, 2) + ":" + dezInt(minutes, 2) + ":" + dezInt(seconds, 2);
}
var TimerHandler = function (interval, autostart) {
        if (typeof(interval) == 'undefined') {
                interval = 1000;
        }
        this._interval = interval;
        this._callbacks = new Array();
        this._intervalId = null;
        if (autostart != false) {
                this.startTimer();
        }
}
TimerHandler.prototype.appendCallback = function (method) {
        var index = this._callbacks.length;
        this._callbacks[this._callbacks.length] = method;
        return index;
}
TimerHandler.prototype.removeCallback = function (index) {
        this._callbacks[index] = null;
}
TimerHandler.prototype.startTimer = function () {
        var instance = this;
        this._intervalId = window.setInterval(function () {
                        instance._timer();
                }, this._interval);
}
TimerHandler.prototype.stopTimer = function () {
        window.clearInterval(this._intervalId);
}
TimerHandler.prototype._timer = function () {
        for (var i = 0; i < this._callbacks.length; i++) {
                if (this._callbacks[i] != null) {
                        this._callbacks[i]();
                }
        }
}
function GetRestTimeFormat(Secs) {
        var s = Secs;
        var m = 0;
        var h = 0;
        if (s > 59) {
                m = Math.floor(s / 60);
                s = s - m * 60;
        }
        if (m > 59) {
                h = Math.floor(m / 60);
                m = m - h * 60;
        }
        return dezInt(h, 2) + ':' + dezInt(m, 2) + ":" + dezInt(s, 2);
}

function OpenPopup(target_url, win_name, width, height) {
        var new_win = window.open(target_url+'&ajax=1', win_name, 'scrollbars=yes,statusbar=no,toolbar=no,location=no,directories=no,resizable=no,menubar=no,width='+width+',height='+height+',screenX='+((screen.width-width) / 2)+",screenY="+((screen.height-height) / 2)+",top="+((screen.height-height) / 2)+",left="+((screen.width-width) / 2));
        new_win.focus();
}

function allydiplo(action, id, level) {
        if(id != '0')
                var vid = "&id="+id;
        else
                var vid = "";
                                
        if(level != '0')
                var vlevel = "&level="+level;
        else
                var vlevel = "";
                
    OpenPopup("game.php?page=alliance&mode=admin&edit=diplo&action="+action+vid+vlevel+"&ajax=1", "diplo", 720, 300);
}


function handleErr(errMessage, url, line) 
{ 
        error = "There is an error at this page.\n";
        error += "Error: " + errMessage+ "\n";
        error += "URL: " + url + "\n";
        error += "Line: " + line + "\n\n";
        error += "Click OK to continue viewing this page,\n";
        alert(error);
        if(typeof console == "object")
                console.log(error);
 
        return true; 
} 

var Dialog      = {
        div: '#popup',
        buttons : {OK: function() { $(Dialog.div).dialog('close') }},
                
        create: function(button, div) {
                div     = div || Dialog.div;
                if($(div).length === 0) {
                        $('body').append('<div id="'+div.substr(1)+'"> </div>');
                        $(div).dialog({
                                autoOpen: false,
                                modal: true,
                                width: 650,
                                buttons: button || Dialog.buttons
                        });
                } else {
                        $(div).dialog('close').dialog('option', 'buttons', button || Dialog.buttons);
                }
                $(div).html('<div style="width:100%;margin:140px 0;text-align:center;vertical-align:middle;font-size:18px;">Loading</div>');
        },
        
        close: function() {
                $(Dialog.div).dialog('close');
        },
        
        info: function(ID){
                Dialog.create();
                $(Dialog.div).dialog('open').load('game.php?page=infos&gid='+ID, function() {
                        $(this).dialog('option', 'title', $('#info_name').text());
                });
                return false;
        },
        
        alert: function(msg, callback){
                Dialog.create({OK:function(){$('#alert').dialog('close');$('#alert').dialog('option', 'width', 650);if(typeof callback==="function")callback();}}, '#alert');
                $('#alert').html('<div style="text-align:center;">'+msg.replace(/\n/g, '<br>')+'</div>').dialog('option', 'width', 300).dialog('option', 'title', head_info).dialog('open');
        },
        
        PM: function(ID, Subject, Message) {
                if(typeof Subject !== 'string')
                        Subject = '';
               Subject = Subject.replace("&apostrofo", "'");
			   
                Dialog.create();
                $(Dialog.div).dialog('open').load('game.php?page=messages&mode=write&id='+ID+'&subject='+encodeURIComponent(Subject), function() {
                        $(this).dialog('option', 'buttons', {Send:function(){if($('#text').val().length==0){Dialog.alert($('#empty').text());}else{$.get('game.php?page=messages&mode=write&id='+ID+'&send=1&'+$('#message').serialize(),function(data){Dialog.alert(data,Dialog.close)})}}})
                        .dialog('option', 'title', $('#head').text())
                        .parent()
                        .find('.ui-dialog-buttonset button span')
                        .text($('#send').text());
                        if(typeof Message === 'string')
                                $('#old_mes').html(decodeURIComponent(Message)+'<hr>');
                });
                return false;
        },
        
        Playercard: function(ID, Name) {
                Dialog.create();
                $(Dialog.div).dialog('open').load('game.php?page=playercard&id='+ID, function() {
                        $(this).dialog('option', 'title', Name);
                });
                return false;
        }
}
