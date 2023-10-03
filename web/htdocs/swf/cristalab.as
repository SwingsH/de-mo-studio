/************************************************
*	http://www.cristalab.com/foros/t32097.html
*************************************************/
MovieClip.prototype.makeCalendar = function () {
   calendarMC = _root.calendar;
   textBox = _root.events_txt;
   firstDayOfWeek = 1;
   myStyles = "style.css";
   myXmlFolder = "xml";
   days = ["S", "M", "T", "W", "T", "F", "S"];
   months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
   // -------------------------------------------------------------- //
   this.init ();
};
//--------------------------------------------------------------//
MovieClip.prototype.init = function () {
   textBox.html = true;
   textBox.wordWrap = true;
   textBox.multiline = true;
   textBox.label.condenseWhite = true;
   textBox_style = new TextField.StyleSheet ();
   textBox_style.load (myStyles);
   textBox.styleSheet = textBox_style;
   now = new Date (), today = now.getDate (), month = now.getMonth (), year = now.getFullYear ();
   lastDate = new Date (year - 1900, month + 1, 0);
   fmt = new TextFormat ();
   this.yearChanger ();
   this.monthChanger ();
   this.getDayNames ();
   this.readXml ();
};
// -------------------------------------------------------------- //
MovieClip.prototype.yearChanger = function () {
   this.attachMovie ("calPrev", "prevYear", this.getNextHighestDepth (), {_x:15, _y:3});
   this.attachMovie ("calNext", "nextYear", this.getNextHighestDepth (), {_x:27.5, _y:3});
   this.createTextField ("yearNow", this.getNextHighestDepth (), 40, 0, 35, 15);
   this.setYearChangers ();
   this.changeYear ();
};
// ------------------------------------------------------------------ //
MovieClip.prototype.monthChanger = function () {
   this.attachMovie ("calPrev", "prevMonth", this.getNextHighestDepth (), {_x:85, _y:3});
   this.attachMovie ("calNext", "nextMonth", this.getNextHighestDepth (), {_x:97.5, _y:3});
   this.createTextField ("monthNow", this.getNextHighestDepth (), 110, 0, 35, 20);
   this.setMonthChangers ();
   this.changeMonth ();
};
// ------------------------------------------------------------------ //
MovieClip.prototype.setYearChangers = function () {
   this.prevYear.onRelease = function () {   year--;   calendarMC.changeYear (); };
   this.nextYear.onRelease = function () { year++;   calendarMC.changeYear (); };
};
// ------------------------------------------------------------------ //
MovieClip.prototype.setMonthChangers = function () {
   this.prevMonth.onRelease = function () {
      if (month == 0) { month = 11; year--; calendarMC.changeYear ();   }
      else { month--; }
      calendarMC.changeMonth ();
   };
   this.nextMonth.onRelease = function () {
      if (month == 11) { month = 0; year++; calendarMC.changeYear ();   }
      else { month++;   }
      calendarMC.changeMonth ();
   };
};
// ------------------------------------------------------------------ //
MovieClip.prototype.changeYear = function () {
   this.yearNow.text = year;
   this.yearNow.setTextFormat (getFormat ("bold"));
   calendarMC.days.unloadMovie ();
   calendarMC.readXml ();
};
// ------------------------------------------------------------------ //
MovieClip.prototype.changeMonth = function () {
   this.monthNow.text = months[month];
   this.monthNow.setTextFormat (getFormat ("bold"));
   calendarMC.days.unloadMovie ();
   calendarMC.readXml ();
};
// ------------------------------------------------------------------ //
MovieClip.prototype.getDayNames = function () {
   for (var i = 0; i < 7; i++) {
      var dow = (i + (firstDayOfWeek + 7)) % 7;
      dayName = this.createEmptyMovieClip (days[dow], this.getNextHighestDepth ());
      dayName._x = 5 + i * 20;
      dayName._y = 20;
      dayName.createTextField ("day", this.getNextHighestDepth (), 0, 0, 20, 15);
      dayName.day.text = days[dow];
      dayName.day.selectable = false;
      dayName.day.setTextFormat (getFormat ());
   }
};
// ------------------------------------------------------------------ //
MovieClip.prototype.readXml = function () {
   writtenDays = new Array ();
   writtenTxts = new Array ();
   xml_load = new XML ();
   xml_load.load (myXmlFolder + "/" + year + "-" + (month + 1) + ".xml");
   xml_load.ignoreWhite = true;
   xml_load.onLoad = function () {
      xmlLength = this.childNodes.length;
      for (var i = 0; i < xmlLength; i++) {
         writtenDays[i] = this.childNodes[i].nodeName;
         writtenTxts[i] = this.childNodes[i].childNodes;
      }
      writtenDays.reverse ();
      writtenTxts.reverse ();
      dayNow = writtenDays.shift ();
      txtNow = writtenTxts.shift ();
      calendarMC.getDates ();
   };
};
// ------------------------------------------------------------------ //
MovieClip.prototype.getDates = function () {
   this.createEmptyMovieClip ("days", this.getNextHighestDepth ());
   var last = lastDate.getDate (), row = 0;
   for (i = 1; i <= last; i++) {
      now.setFullYear (year, month, i);
      var offset = (now.getDay () - firstDayOfWeek) % 7;
      offset < 0 ? dow = offset + 7 : dow = offset;
      day = this.days.createEmptyMovieClip ("day" + i, this.getNextHighestDepth () + i);
      day._x = 5 + dow * 20;
      day._y = 45 + row * 20;
      checkClick ();
      day.createTextField ("date", this.getNextHighestDepth (), 0, 0, 20, 15);
      day.date.text = i;
      day.date.selectable = false;
      day.date.setTextFormat (getFormat ());
      if (dow == 6) row++;
   }
};
// ------------------------------------------------------------------ //
MovieClip.prototype.checkClick = function () {
   if (dayNow == i) {
      day.drawBg (0x475a6d);
      dayNow = writtenDays.shift ();
   }
};
// ------------------------------------------------------------------ //
MovieClip.prototype.drawBg = function (color) {
   var bg = this.createEmptyMovieClip ("bg", this.getNextHighestDepth ());
   var day = this._parent;
   bg.lineStyle (0, color, 100);
   bg.beginFill (color, 100);
   bg.moveTo (day._x + 1, day._y - 1);
   bg.lineTo (day._x + 18, day._y - 1);
   bg.lineTo (day._x + 18, day._y + 17);
   bg.lineTo (day._x + 1, day._y + 17);
   bg.lineTo (day._x + 1, day._y - 1);
   bg.endFill ();
   bg.setClick ();
};
// ------------------------------------------------------------------ //
MovieClip.prototype.getFormat = function (form:String) {
   if (form == "bold") {
      fmt.font = "Verdana", fmt.size = 10, fmt.bold = true, fmt.color = 0x475a6d, fmt.align = "left";
      return (fmt);
   }
   if (this.day.bg) {
      fmt.font = "Verdana", fmt.size = 10, fmt.bold = false, fmt.color = 0xffffff, fmt.align = "center";
      return (fmt);
   }
   fmt.font = "Verdana", fmt.size = 10, fmt.bold = false, fmt.color = 0x475a6d, fmt.align = "center";
   return (fmt);
};
// ------------------------------------------------------------------ //
MovieClip.prototype.setClick = function () {
   this.txt = txtNow.join ("");
   txtNow = writtenTxts.shift ();
   this.onRelease = function () { textBox.text = this.txt;   };
};
// ------------------------------------------------------------------ //

//funciones globales
Clamp = function (min, n, max) {
   if (n < min) {
      return min;
   }
   if (n > max) {
      return max;
   }
   return n;
};
//scrollbar
// referencias
scrollbar.range = scrollbar._height;
scrollbar.top = scrollbar._y;
// metodos
scrollbar.resize = function (size_factor) {
   this.body._yscale = Clamp (0, 100 * size_factor, 100);
   this.cap._y = this.body._y + this.body._height;
};
scrollbar.updateSize = function () {
   if (!this.contentCanScroll ()) {
      this.noScroll ();
   } else {
      var range = this.target.txt.bottomScroll - this.target.txt.scroll;
      this.resize (range / (this.target.txt.maxscroll + range));
   }
};
scrollbar.setBarScroll = function (percent) {
   if (percent == 0) {
      this._y = this.top;
   } else {
      var bottom = this.top + (this.range - this._height);
      var position = this.top + (this.range - this._height) * percent;
      this._y = Clamp (this.top, position, bottom);
   }
};
scrollbar.getBarScroll = function () {
   return (this._y - this.top) / (this.range - this._height);
};
scrollbar.updateBarScroll = function () {
   this.updateSize ();
   this.setBarScroll ((this.target.txt.scroll - 1) / (this.target.txt.maxscroll - 1));
};
scrollbar.updateContentScroll = function () {
   if (!this.contentCanScroll ()) {
      this.noScroll ();
   } else {
      this.target.txt.scroll = 1 + Math.round ((this.target.txt.maxscroll - 1) * this.getBarScroll ());
   }
   this.target.last_scroll = this.target.txt.scroll;
};
scrollbar.setScroll = function (percent) {
   this.setBarScroll (percent);
   this.updateContentScroll ();
};
scrollbar.noScroll = function () {
   this.target.txt.scroll = 1;
   this._y = this.top;
   this.resize (1);
};
// revisores
scrollbar.contentCanScroll = function () {
   return (this.target.txt.maxscroll > 1);
};
scrollbar.contentChanged = function () {
   // checker/reactor
   if (this.target.txt.text != this.target.content) {
      this.target.content = this.target.txt.text;
      this.updateBarScroll ();
   } else if (this.target.last_scroll != this.target.txt.scroll) {
      this.target.last_scroll = this.target.txt.scroll;
      this.updateBarScroll ();
   }
};
// interacción
scrollbar.drag = function () {
   if (this.body._yscale >= 100) {
      return (0);
   }
   var position = this._parent._ymouse - this._yoffset;
   var bottom = this.top + this.range - this._height;
   this._y = Clamp (this.top, position, bottom);
   this.updateContentScroll ();
   updateAfterEvent ();
};
scrollbar.onPress = function () {
   this._yoffset = this._ymouse;
   this.onMouseMove = this.drag;
};
scrollbar.onRelease = scrollbar.onReleaseOutside = function () {
   delete this.onMouseMove;
};
// define
scrollbar.setTarget = function (txt) {
   this.target = {txt:txt, content:this.target.txt.text, last_scroll:this.target.txt.scroll};
   this.resize (txt.scroll / txt.maxscroll);
};
// poll for content changes
scrollbar.onEnterFrame = scrollbar.contentChanged;
scrollbar.setScroll (0);
scrollbar.setTarget (events_txt);
