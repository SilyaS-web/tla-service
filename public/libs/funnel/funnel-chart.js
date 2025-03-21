/*!
 * Funnel Chart v1.1.1
 * https://github.com/promotably/funnel-chart
 *
 * Copyright 2015 Promotably LLC
 * Released under the MIT license
 */
(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        define(factory);
    } else if (typeof module === 'object' && module.exports) {
        module.exports = factory();
    } else {
        root.FunnelChart = factory();
    }
}(this, function () {

    function extend(out) {
        out = out || {};

        for (var i = 1; i < arguments.length; i++) {
            if (!arguments[i])
                continue;

            for (var key in arguments[i]) {
                if (arguments[i].hasOwnProperty(key))
                    out[key] = arguments[i][key];
            }
        }

        return out;
    }

    // canvas arg can be an ID string or HTMLElement
    function FunnelChart(canvas, settings) {
        // Allows FunnelChart to be instantiated without use of "new"
        if (!(this instanceof FunnelChart))
            return new FunnelChart(canvas, settings);

        // Ensure canvas is an HTMLElement
        this.canvas = (typeof canvas === 'string') ?
            document.getElementById(canvas) : canvas;

        // TODO: Check settings.values exists
        if (!settings.values || !settings.values.length)
            throw ('A values setting must be provided');

        // Extend default settings
        this.settings = extend(this.settings, settings);

        // Init!
        this.initialize();
    }

    function getOffset(el) {
        var _x = 0;
        var _y = 0;
        while (el && !isNaN(el.offsetLeft) && !isNaN(el.offsetTop)) {
            _x += el.offsetLeft - el.scrollLeft;
            _y += el.offsetTop - el.scrollTop;
            el = el.offsetParent;
        }
        return {
            top: _y,
            left: _x
        };
    }

    FunnelChart.prototype = extend(FunnelChart.prototype, {

        settings: {

            // Boolean - Whether to display % change between sections
            displayPercentageChange: true,

            // Number - The number of decimal places that should be displayed for %
            // change values
            pPrecision: 1,

            // String - The color of the horizontal label lines (if labels are shown)
            labelLineColor: '#eee',

            // String or Array - The font color(s) of the labels.
            labelFontColor: '#657274',

            // String or Array - The color(s) of the funnel sections.
            sectionColor: '#0498b3',

            // String or Array - The color(s) of the funnel percentage sections.
            pSectionColor: '#bfd1d4',

            // String - The font for labels and values
            font: 'Inter',

            // Number - The maximum font size in pixels (px) for labels and values.
            // This will always be used where possible unless the height of the
            // funnel sections is too small to permit it, in which case the font size
            // will be automatically reduced to fit
            maxFontSize: 14,

            // String - The font weight for labels and values
            fontWeight: '400',

            // String or Array - The font color(s) for funnel sections
            sectionFontColor: '#fff',

            // String or Array - The font color(s) for % change sections
            pSectionFontColor: '#000',

            // Number - The height of the % change sections compared to the main
            // funnel sections. This is a percent value.
            pSectionHeightPercent: 100,

            // Number - The percentage of the full canvas width that should be
            // reserved for display of labels (if provided). The funnel will expand
            // to fit the remainder.
            labelWidthPercent: 30,

            // Number - The percentage width difference between the top and the
            // bottom of the funnel.
            funnelReductionPercent: 40,

            // Number - The space between the right hand edge of the funnel and the
            // label text in pixels.
            labelOffset: 10,

            // Number - The line height between each funnel section
            lineHeight: 1,

            // return response for clicked section
            callback: function (obj) {
                console.dir(obj);
            }
        },

        initialize: function () {
            this.calculateDimensions();
            this.draw();
        },

        calculateDimensions: function () {
            var settings = this.settings,
                labelWidth, sectionTotalHeight, multiplier;

            // Width and height of canvas
            this.width = this.canvas.offsetWidth;
            this.height = this.canvas.offsetHeight;

            // Ensure canvas dimensions are correct for device pixel ratio
            this.createHiDPICanvas();

            // Width allocated to labels
            labelWidth = this.hasLabels() ? this.width * (settings.labelWidthPercent / 100) : 0;
            this.labelMaxWidth = labelWidth - settings.labelOffset;

            // Start and end width of funnel
            this.startWidth = this.width - labelWidth;
            this.endWidth = this.startWidth * (settings.funnelReductionPercent / 100);

            // Total height of each section
            sectionTotalHeight = (this.height / (settings.values.length));

            // Section heights
            if (settings.displayPercentageChange) {
                multiplier = this.height / (this.height - (sectionTotalHeight / (100 + settings.pSectionHeightPercent)) * settings.pSectionHeightPercent);
                this.sectionHeight = (multiplier * ((sectionTotalHeight / (100 + settings.pSectionHeightPercent)) * 100));
                this.pSectionHeight = (multiplier * ((sectionTotalHeight / (100 + settings.pSectionHeightPercent)) * settings.pSectionHeightPercent));
            } else {
                this.sectionHeight = sectionTotalHeight;
                this.pSectionHeight = 0;
            }
        },

        pixelRatio: function () {
            var ctx = this.canvas.getContext('2d'),
                dpr = window.devicePixelRatio || 1,
                bsr = ctx.webkitBackingStorePixelRatio ||
                ctx.mozBackingStorePixelRatio ||
                ctx.msBackingStorePixelRatio ||
                ctx.oBackingStorePixelRatio ||
                ctx.backingStorePixelRatio || 1;
            return dpr / bsr;
        },

        createHiDPICanvas: function () {
            var canvas = this.canvas,
                ratio = this.pixelRatio(),
                w = this.width,
                h = this.height;

            canvas.width = w * ratio;
            canvas.height = h * ratio;
            canvas.style.width = w + 'px';
            canvas.style.height = h + 'px';
            canvas.getContext('2d').setTransform(ratio, 0, 0, ratio, 0, 0);
        },

        rect: function (id, x, y, width, height, fill, stroke, strokewidth) {
            return {
                id: id,
                x: x,
                y: y,
                width: width,
                height: height,
                fill: fill || "gray",
                stroke: stroke || "skyblue",
                strokewidth: strokewidth || 2,
                isPointInside: function (x, y) {
                    //                    console.log(this.id + " Si (" + x + " >= " + this.x + " && " + x + " <= " + parseInt(this.x + this.width) + ") &&  (" + y + " <= " + parseInt(this.y + this.height) + ")");
                    return (x >= this.x && x <= this.x + this.width && y >= this.y && y <= this.y + this.height);
                }
            };
        },

        draw: function () {
            var canvas = this.canvas,
                settings = this.settings;

            if (canvas.getContext) {
                var ctx = canvas.getContext('2d'),
                    maxAvailFontSize = ((settings.displayPercentageChange) ? this.pSectionHeight : this.sectionHeight) - 2;

                // Reduce font size if necessary
                if (settings.maxFontSize >= maxAvailFontSize)
                    settings.maxFontSize = maxAvailFontSize;

                // Configure font styling
                ctx.font = settings.fontWeight + ' ' + settings.maxFontSize + 'px ' + settings.font;

                // Draw labels if we have any
                if (this.hasLabels()) this.drawLabels(ctx);

                // Draw funnel clipping area with white background
                this.drawClippingArea(ctx, settings);
                ctx.fillStyle = '#fff';
                ctx.fill();
                ctx.clip();

                // Draw funnel sections
                this.drawSections(ctx);

                // Tidy up funnel outline
                this.drawClippingArea(ctx, settings, true);
                ctx.lineWidth = 2;
                ctx.strokeStyle = '#fff';
                ctx.stroke();
            }
        },

        drawLabels: function (ctx) {
            var settings = this.settings,
                i, yPos;

            ctx.strokeStyle = settings.labelLineColor;
            ctx.lineWidth = settings.lineHeight;

            for (i = 0; i < settings.values.length; i++) {
                yPos = this.calculateYPos(i) - 1;

                ctx.fillStyle = this.sequentialValue(settings.labelFontColor, i);
                ctx.fillText(
                    settings.labels[i] || '',
                    this.startWidth + settings.labelOffset,
                    yPos + (this.sectionHeight / 2) + (settings.maxFontSize / 2) - 2,
                    this.labelMaxWidth
                );

                if (i > 0) {
                    ctx.beginPath();
                    ctx.moveTo(i, yPos);
                    ctx.lineTo(this.width, yPos);
                    ctx.stroke();
                }

                if (i < (settings.values.length - 1) && settings.displayPercentageChange) {
                    ctx.beginPath();
                    ctx.moveTo(i, yPos + this.sectionHeight);
                    ctx.lineTo(this.width, yPos + this.sectionHeight);
                    ctx.stroke();
                }

            }
        },

        drawClippingArea: function (ctx, settings, curvesOnly) {
            var inset = (this.startWidth - this.endWidth) / 2;
            var height = (settings.values.length * this.sectionHeight) +
                ((settings.values.length - 1) * this.pSectionHeight) +
                (settings.values.length + 1),
                lineOrMove = curvesOnly ? 'moveTo' : 'lineTo';

            ctx.beginPath();
            ctx.moveTo(0, 0);
            ctx[lineOrMove](this.startWidth, 0);
            ctx.quadraticCurveTo(
                (this.startWidth - inset),
                (height / 3),
                (this.startWidth - inset),
                height
            );
            ctx[lineOrMove](inset, height);
            ctx.quadraticCurveTo(inset, (height / 3), 0, 0);
        },

        drawSections: function (ctx) {
            var rects = [];
            var canvasOffset = typeof jQuery !== "undefined" ? jQuery(this.canvas).offset() : getOffset(this.canvas);
            var offsetX = canvasOffset.left;
            var offsetY = canvasOffset.top;

            var settings = this.settings,
                i, yPos;

            ctx.textAlign = 'center';

            for (i = 0; i < settings.values.length; i++) {
                yPos = this.calculateYPos(i);

                ctx.fillStyle = this.sequentialValue(settings.sectionColor, i);
                ctx.fillRect(0, yPos, this.startWidth, this.sectionHeight - settings.lineHeight);
                ctx.fillStyle = this.sequentialValue(settings.sectionFontColor, i);
                ctx.fillText(
                    settings.values[i],
                    this.startWidth / 2,
                    yPos + ((this.sectionHeight - settings.lineHeight) / 2) + (settings.maxFontSize / 2) - 2
                );

                if (i < (settings.values.length - 1) && settings.displayPercentageChange) {
                    ctx.fillStyle = this.sequentialValue(settings.pSectionColor, i);
                    ctx.fillRect(
                        0,
                        (yPos + this.sectionHeight),
                        this.startWidth,
                        this.pSectionHeight - settings.lineHeight
                    );

                    ctx.fillStyle = this.sequentialValue(settings.pSectionFontColor, i);
                    ctx.fillText(
                        (settings.values[i] === 0) ? '' : ((settings.values[i + 1] / settings.values[i]) * 100).toFixed(settings.pPrecision) + '%',
                        this.startWidth / 2,
                        yPos + this.sectionHeight + ((this.pSectionHeight - settings.lineHeight) / 2) + (settings.maxFontSize / 2) - 1
                    );
                }
                // stroring sections
                rects.push(this.rect(settings.labels[i], 0, yPos, this.startWidth, this.sectionHeight - settings.lineHeight, settings.sectionColor[i]));
            }

            // author: Jeison Nisperuza
            ctx.canvas.addEventListener('click', function (e) {
                // Put your mousedown stuff here
                var clicked;
                var mouseX = Math.abs(parseInt(e.clientX - offsetX));
                var mouseY = Math.abs(parseInt(e.clientY - offsetY));

                console.log(mouseX, mouseY);

                for (var i = 0; i < rects.length; i++) {

                    if (rects[i].isPointInside(mouseX, mouseY)) {
                        clicked = rects[i];
                        break;
                    }
                }
                if (clicked) {
                    clicked.allSettings = settings;
                    if (typeof settings.callback === 'function') settings.callback(clicked);
                }

            }, false);

        },

        hasLabels: function () {
            var labels = this.settings.labels;
            return labels && !!labels.length;
        },

        calculateYPos: function (i) {
            var sectionHeight = this.sectionHeight;
            if (this.settings.displayPercentageChange) sectionHeight += this.pSectionHeight;
            return sectionHeight * i;
        },

        sequentialValue: function (arr, i) {
            if (typeof arr === 'string') return arr;
            return arr[i % arr.length];
        }

    });

    return FunnelChart;

}));
