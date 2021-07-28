/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 29);
/******/ })
/************************************************************************/
/******/ ({

/***/ 29:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(30);


/***/ }),

/***/ 30:
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var zlibes = function (exports) {
    'use strict';

    function calcAdler32(input) {
        var s1 = 1;
        var s2 = 0;
        var inputLen = input.length;
        for (var i = 0; i < inputLen; i++) {
            s1 = (s1 + input[i]) % 65521;
            s2 = (s1 + s2) % 65521;
        }
        return (s2 << 16) + s1;
    }

    var BTYPE = Object.freeze({
        UNCOMPRESSED: 0,
        FIXED: 1,
        DYNAMIC: 2
    });
    var BLOCK_MAX_BUFFER_LEN = 131072;
    var LENGTH_EXTRA_BIT_LEN = [0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 2, 2, 2, 2, 3, 3, 3, 3, 4, 4, 4, 4, 5, 5, 5, 5, 0];
    var LENGTH_EXTRA_BIT_BASE = [3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 15, 17, 19, 23, 27, 31, 35, 43, 51, 59, 67, 83, 99, 115, 131, 163, 195, 227, 258];
    var DISTANCE_EXTRA_BIT_BASE = [1, 2, 3, 4, 5, 7, 9, 13, 17, 25, 33, 49, 65, 97, 129, 193, 257, 385, 513, 769, 1025, 1537, 2049, 3073, 4097, 6145, 8193, 12289, 16385, 24577];
    var DISTANCE_EXTRA_BIT_LEN = [0, 0, 0, 0, 1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6, 7, 7, 8, 8, 9, 9, 10, 10, 11, 11, 12, 12, 13, 13];
    var CODELEN_VALUES = [16, 17, 18, 0, 8, 7, 9, 6, 10, 5, 11, 4, 12, 3, 13, 2, 14, 1, 15];

    function generateHuffmanTable(codelenValues) {
        var codelens = Object.keys(codelenValues);
        var codelen = 0;
        var codelenMax = 0;
        var codelenMin = Number.MAX_SAFE_INTEGER;
        codelens.forEach(function (key) {
            codelen = Number(key);
            if (codelenMax < codelen) {
                codelenMax = codelen;
            }
            if (codelenMin > codelen) {
                codelenMin = codelen;
            }
        });
        var code = 0;
        var values = void 0;
        var bitlenTables = {};

        var _loop = function _loop(bitlen) {
            values = codelenValues[bitlen];
            if (values === undefined) {
                values = [];
            }
            values.sort(function (a, b) {
                if (a < b) {
                    return -1;
                }
                if (a > b) {
                    return 1;
                }
                return 0;
            });
            var table = {};
            values.forEach(function (value) {
                table[code] = value;
                code++;
            });
            bitlenTables[bitlen] = table;
            code <<= 1;
        };

        for (var bitlen = codelenMin; bitlen <= codelenMax; bitlen++) {
            _loop(bitlen);
        }
        return bitlenTables;
    }
    function makeFixedHuffmanCodelenValues() {
        var codelenValues = {};
        codelenValues[7] = [];
        codelenValues[8] = [];
        codelenValues[9] = [];
        for (var i = 0; i <= 287; i++) {
            i <= 143 ? codelenValues[8].push(i) : i <= 255 ? codelenValues[9].push(i) : i <= 279 ? codelenValues[7].push(i) : codelenValues[8].push(i);
        }
        return codelenValues;
    }
    function generateDeflateHuffmanTable(values) {
        var maxLength = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 15;

        var valuesCount = {};
        var _iteratorNormalCompletion = true;
        var _didIteratorError = false;
        var _iteratorError = undefined;

        try {
            for (var _iterator = values[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                var value = _step.value;

                if (!valuesCount[value]) {
                    valuesCount[value] = 1;
                } else {
                    valuesCount[value]++;
                }
            }
        } catch (err) {
            _didIteratorError = true;
            _iteratorError = err;
        } finally {
            try {
                if (!_iteratorNormalCompletion && _iterator.return) {
                    _iterator.return();
                }
            } finally {
                if (_didIteratorError) {
                    throw _iteratorError;
                }
            }
        }

        var valuesCountKeys = Object.keys(valuesCount);
        var tmpPackages = [];
        var tmpPackageIndex = 0;
        var packages = [];
        if (valuesCountKeys.length === 1) {
            packages.push({
                count: valuesCount[0],
                simbles: [Number(valuesCountKeys[0])]
            });
        } else {
            for (var i = 0; i < maxLength; i++) {
                packages = [];
                valuesCountKeys.forEach(function (value) {
                    var pack = {
                        count: valuesCount[Number(value)],
                        simbles: [Number(value)]
                    };
                    packages.push(pack);
                });
                tmpPackageIndex = 0;
                while (tmpPackageIndex + 2 <= tmpPackages.length) {
                    var pack = {
                        count: tmpPackages[tmpPackageIndex].count + tmpPackages[tmpPackageIndex + 1].count,
                        simbles: tmpPackages[tmpPackageIndex].simbles.concat(tmpPackages[tmpPackageIndex + 1].simbles)
                    };
                    packages.push(pack);
                    tmpPackageIndex += 2;
                }
                packages = packages.sort(function (a, b) {
                    if (a.count < b.count) {
                        return -1;
                    }
                    if (a.count > b.count) {
                        return 1;
                    }
                    return 0;
                });
                if (packages.length % 2 !== 0) {
                    packages.pop();
                }
                tmpPackages = packages;
            }
        }
        var valuesCodelen = {};
        packages.forEach(function (pack) {
            pack.simbles.forEach(function (symble) {
                if (!valuesCodelen[symble]) {
                    valuesCodelen[symble] = 1;
                } else {
                    valuesCodelen[symble]++;
                }
            });
        });
        var group = void 0;
        var valuesCodelenKeys = Object.keys(valuesCodelen);
        var codelenGroup = {};
        var code = 0;
        var codelen = 3;
        var codelenValueMin = Number.MAX_SAFE_INTEGER;
        var codelenValueMax = 0;
        valuesCodelenKeys.forEach(function (valuesCodelenKey) {
            codelen = valuesCodelen[Number(valuesCodelenKey)];
            if (!codelenGroup[codelen]) {
                codelenGroup[codelen] = [];
                if (codelenValueMin > codelen) {
                    codelenValueMin = codelen;
                }
                if (codelenValueMax < codelen) {
                    codelenValueMax = codelen;
                }
            }
            codelenGroup[codelen].push(Number(valuesCodelenKey));
        });
        code = 0;
        var table = new Map();

        var _loop2 = function _loop2(_i) {
            group = codelenGroup[_i];
            if (group) {
                group = group.sort(function (a, b) {
                    if (a < b) {
                        return -1;
                    }
                    if (a > b) {
                        return 1;
                    }
                    return 0;
                });
                group.forEach(function (value) {
                    table.set(value, { code: code, bitlen: _i });
                    code++;
                });
            }
            code <<= 1;
        };

        for (var _i = codelenValueMin; _i <= codelenValueMax; _i++) {
            _loop2(_i);
        }
        return table;
    }

    var REPEAT_LEN_MIN = 3;
    var FAST_INDEX_CHECK_MAX = 128;
    var FAST_INDEX_CHECK_MIN = 16;
    var FAST_REPEAT_LENGTH = 8;
    function generateLZ77IndexMap(input, startIndex, targetLength) {
        var end = startIndex + targetLength - REPEAT_LEN_MIN;
        var indexMap = {};
        for (var i = startIndex; i <= end; i++) {
            var indexKey = input[i] << 16 | input[i + 1] << 8 | input[i + 2];
            if (indexMap[indexKey] === undefined) {
                indexMap[indexKey] = [];
            }
            indexMap[indexKey].push(i);
        }
        return indexMap;
    }
    function generateLZ77Codes(input, startIndex, targetLength) {
        var nowIndex = startIndex;
        var endIndex = startIndex + targetLength - REPEAT_LEN_MIN;
        var slideIndexBase = 0;
        var repeatLength = 0;
        var repeatLengthMax = 0;
        var repeatLengthMaxIndex = 0;
        var distance = 0;
        var repeatLengthCodeValue = 0;
        var repeatDistanceCodeValue = 0;
        var codeTargetValues = [];
        var startIndexMap = {};
        var endIndexMap = {};
        var indexMap = generateLZ77IndexMap(input, startIndex, targetLength);
        while (nowIndex <= endIndex) {
            var indexKey = input[nowIndex] << 16 | input[nowIndex + 1] << 8 | input[nowIndex + 2];
            var indexes = indexMap[indexKey];
            if (indexes === undefined || indexes.length <= 1) {
                codeTargetValues.push([input[nowIndex]]);
                nowIndex++;
                continue;
            }
            slideIndexBase = nowIndex > 0x8000 ? nowIndex - 0x8000 : 0;
            repeatLengthMax = 0;
            repeatLengthMaxIndex = 0;
            var skipindexes = startIndexMap[indexKey] || 0;
            while (indexes[skipindexes] < slideIndexBase) {
                skipindexes = skipindexes + 1 | 0;
            }
            startIndexMap[indexKey] = skipindexes;
            skipindexes = endIndexMap[indexKey] || 0;
            while (indexes[skipindexes] < nowIndex) {
                skipindexes = skipindexes + 1 | 0;
            }
            endIndexMap[indexKey] = skipindexes;
            var checkCount = 0;
            indexMapLoop: for (var i = endIndexMap[indexKey] - 1, iMin = startIndexMap[indexKey]; iMin <= i; i--) {
                if (checkCount >= FAST_INDEX_CHECK_MAX || repeatLengthMax >= FAST_REPEAT_LENGTH && checkCount >= FAST_INDEX_CHECK_MIN) {
                    break;
                }
                checkCount++;
                var index = indexes[i];
                for (var j = repeatLengthMax - 1; 0 < j; j--) {
                    if (input[index + j] !== input[nowIndex + j]) {
                        continue indexMapLoop;
                    }
                }
                repeatLength = 258;
                for (var _j = repeatLengthMax; _j <= 258; _j++) {
                    if (input[index + _j] !== input[nowIndex + _j]) {
                        repeatLength = _j;
                        break;
                    }
                }
                if (repeatLengthMax < repeatLength) {
                    repeatLengthMax = repeatLength;
                    repeatLengthMaxIndex = index;
                    if (258 <= repeatLength) {
                        break;
                    }
                }
            }
            if (repeatLengthMax >= 3 && nowIndex + repeatLengthMax <= endIndex) {
                distance = nowIndex - repeatLengthMaxIndex;
                for (var _i2 = 0; _i2 < LENGTH_EXTRA_BIT_BASE.length; _i2++) {
                    if (LENGTH_EXTRA_BIT_BASE[_i2] > repeatLengthMax) {
                        break;
                    }
                    repeatLengthCodeValue = _i2;
                }
                for (var _i3 = 0; _i3 < DISTANCE_EXTRA_BIT_BASE.length; _i3++) {
                    if (DISTANCE_EXTRA_BIT_BASE[_i3] > distance) {
                        break;
                    }
                    repeatDistanceCodeValue = _i3;
                }
                codeTargetValues.push([repeatLengthCodeValue, repeatDistanceCodeValue, repeatLengthMax, distance]);
                nowIndex += repeatLengthMax;
            } else {
                codeTargetValues.push([input[nowIndex]]);
                nowIndex++;
            }
        }
        codeTargetValues.push([input[nowIndex]]);
        codeTargetValues.push([input[nowIndex + 1]]);
        return codeTargetValues;
    }

    var BitWriteStream = function () {
        function BitWriteStream(buffer) {
            var bufferOffset = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
            var bitsOffset = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0;

            _classCallCheck(this, BitWriteStream);

            this.nowBitsIndex = 0;
            this.isEnd = false;
            this.buffer = buffer;
            this.bufferIndex = bufferOffset;
            this.nowBits = buffer[bufferOffset];
            this.nowBitsIndex = bitsOffset;
        }

        _createClass(BitWriteStream, [{
            key: 'write',
            value: function write(bit) {
                if (this.isEnd) {
                    throw new Error('Lack of data length');
                }
                bit <<= this.nowBitsIndex;
                this.nowBits += bit;
                this.nowBitsIndex++;
                if (this.nowBitsIndex >= 8) {
                    this.buffer[this.bufferIndex] = this.nowBits;
                    this.bufferIndex++;
                    this.nowBits = 0;
                    this.nowBitsIndex = 0;
                    if (this.buffer.length <= this.bufferIndex) {
                        this.isEnd = true;
                    }
                }
            }
        }, {
            key: 'writeRange',
            value: function writeRange(value, length) {
                var mask = 1;
                var bit = 0;
                for (var i = 0; i < length; i++) {
                    bit = value & mask ? 1 : 0;
                    this.write(bit);
                    mask <<= 1;
                }
            }
        }, {
            key: 'writeRangeCoded',
            value: function writeRangeCoded(value, length) {
                var mask = 1 << length - 1;
                var bit = 0;
                for (var i = 0; i < length; i++) {
                    bit = value & mask ? 1 : 0;
                    this.write(bit);
                    mask >>>= 1;
                }
            }
        }]);

        return BitWriteStream;
    }();

    function deflate(input) {
        var inputLength = input.length;
        var streamHeap = inputLength < BLOCK_MAX_BUFFER_LEN / 2 ? BLOCK_MAX_BUFFER_LEN : inputLength * 2;
        var stream = new BitWriteStream(new Uint8Array(streamHeap));
        var processedLength = 0;
        var targetLength = 0;
        while (true) {
            if (processedLength + BLOCK_MAX_BUFFER_LEN >= inputLength) {
                targetLength = inputLength - processedLength;
                stream.writeRange(1, 1);
            } else {
                targetLength = BLOCK_MAX_BUFFER_LEN;
                stream.writeRange(0, 1);
            }
            stream.writeRange(BTYPE.DYNAMIC, 2);
            deflateDynamicBlock(stream, input, processedLength, targetLength);
            processedLength += BLOCK_MAX_BUFFER_LEN;
            if (processedLength >= inputLength) {
                break;
            }
        }
        if (stream.nowBitsIndex !== 0) {
            stream.writeRange(0, 8 - stream.nowBitsIndex);
        }
        return stream.buffer.subarray(0, stream.bufferIndex);
    }
    function deflateDynamicBlock(stream, input, startIndex, targetLength) {
        var lz77Codes = generateLZ77Codes(input, startIndex, targetLength);
        var clCodeValues = [256]; // character or matching length
        var distanceCodeValues = [];
        var clCodeValueMax = 256;
        var distanceCodeValueMax = 0;
        for (var i = 0, iMax = lz77Codes.length; i < iMax; i++) {
            var values = lz77Codes[i];
            var cl = values[0];
            var distance = values[1];
            if (distance !== undefined) {
                cl += 257;
                distanceCodeValues.push(distance);
                if (distanceCodeValueMax < distance) {
                    distanceCodeValueMax = distance;
                }
            }
            clCodeValues.push(cl);
            if (clCodeValueMax < cl) {
                clCodeValueMax = cl;
            }
        }
        var dataHuffmanTables = generateDeflateHuffmanTable(clCodeValues);
        var distanceHuffmanTables = generateDeflateHuffmanTable(distanceCodeValues);
        var codelens = [];
        for (var _i4 = 0; _i4 <= clCodeValueMax; _i4++) {
            if (dataHuffmanTables.has(_i4)) {
                codelens.push(dataHuffmanTables.get(_i4).bitlen);
            } else {
                codelens.push(0);
            }
        }
        var HLIT = codelens.length;
        for (var _i5 = 0; _i5 <= distanceCodeValueMax; _i5++) {
            if (distanceHuffmanTables.has(_i5)) {
                codelens.push(distanceHuffmanTables.get(_i5).bitlen);
            } else {
                codelens.push(0);
            }
        }
        var HDIST = codelens.length - HLIT;
        var runLengthCodes = [];
        var runLengthRepeatCount = [];
        var codelen = 0;
        var repeatLength = 0;
        for (var _i6 = 0; _i6 < codelens.length; _i6++) {
            codelen = codelens[_i6];
            repeatLength = 1;
            while (codelen === codelens[_i6 + 1]) {
                repeatLength++;
                _i6++;
                if (codelen === 0) {
                    if (138 <= repeatLength) {
                        break;
                    }
                } else {
                    if (6 <= repeatLength) {
                        break;
                    }
                }
            }
            if (4 <= repeatLength) {
                if (codelen === 0) {
                    if (11 <= repeatLength) {
                        runLengthCodes.push(18);
                    } else {
                        runLengthCodes.push(17);
                    }
                } else {
                    runLengthCodes.push(codelen);
                    runLengthRepeatCount.push(1);
                    repeatLength--;
                    runLengthCodes.push(16);
                }
                runLengthRepeatCount.push(repeatLength);
            } else {
                for (var j = 0; j < repeatLength; j++) {
                    runLengthCodes.push(codelen);
                    runLengthRepeatCount.push(1);
                }
            }
        }
        var codelenHuffmanTable = generateDeflateHuffmanTable(runLengthCodes, 7);
        var HCLEN = 0;
        CODELEN_VALUES.forEach(function (value, index) {
            if (codelenHuffmanTable.has(value)) {
                HCLEN = index + 1;
            }
        });
        // HLIT
        stream.writeRange(HLIT - 257, 5);
        // HDIST
        stream.writeRange(HDIST - 1, 5);
        // HCLEN
        stream.writeRange(HCLEN - 4, 4);
        var codelenTableObj = void 0;
        // codelenHuffmanTable
        for (var _i7 = 0; _i7 < HCLEN; _i7++) {
            codelenTableObj = codelenHuffmanTable.get(CODELEN_VALUES[_i7]);
            if (codelenTableObj !== undefined) {
                stream.writeRange(codelenTableObj.bitlen, 3);
            } else {
                stream.writeRange(0, 3);
            }
        }
        runLengthCodes.forEach(function (value, index) {
            codelenTableObj = codelenHuffmanTable.get(value);
            if (codelenTableObj !== undefined) {
                stream.writeRangeCoded(codelenTableObj.code, codelenTableObj.bitlen);
            } else {
                throw new Error('Data is corrupted');
            }
            if (value === 18) {
                stream.writeRange(runLengthRepeatCount[index] - 11, 7);
            } else if (value === 17) {
                stream.writeRange(runLengthRepeatCount[index] - 3, 3);
            } else if (value === 16) {
                stream.writeRange(runLengthRepeatCount[index] - 3, 2);
            }
        });
        for (var _i8 = 0, _iMax = lz77Codes.length; _i8 < _iMax; _i8++) {
            var _values = lz77Codes[_i8];
            var clCodeValue = _values[0];
            var distanceCodeValue = _values[1];
            if (distanceCodeValue !== undefined) {
                codelenTableObj = dataHuffmanTables.get(clCodeValue + 257);
                if (codelenTableObj === undefined) {
                    throw new Error('Data is corrupted');
                }
                stream.writeRangeCoded(codelenTableObj.code, codelenTableObj.bitlen);
                if (0 < LENGTH_EXTRA_BIT_LEN[clCodeValue]) {
                    repeatLength = _values[2];
                    stream.writeRange(repeatLength - LENGTH_EXTRA_BIT_BASE[clCodeValue], LENGTH_EXTRA_BIT_LEN[clCodeValue]);
                }
                var distanceTableObj = distanceHuffmanTables.get(distanceCodeValue);
                if (distanceTableObj === undefined) {
                    throw new Error('Data is corrupted');
                }
                stream.writeRangeCoded(distanceTableObj.code, distanceTableObj.bitlen);
                if (0 < DISTANCE_EXTRA_BIT_LEN[distanceCodeValue]) {
                    var _distance = _values[3];
                    stream.writeRange(_distance - DISTANCE_EXTRA_BIT_BASE[distanceCodeValue], DISTANCE_EXTRA_BIT_LEN[distanceCodeValue]);
                }
            } else {
                codelenTableObj = dataHuffmanTables.get(clCodeValue);
                if (codelenTableObj === undefined) {
                    throw new Error('Data is corrupted');
                }
                stream.writeRangeCoded(codelenTableObj.code, codelenTableObj.bitlen);
            }
        }
        codelenTableObj = dataHuffmanTables.get(256);
        if (codelenTableObj === undefined) {
            throw new Error('Data is corrupted');
        }
        stream.writeRangeCoded(codelenTableObj.code, codelenTableObj.bitlen);
    }

    var BitReadStream = function () {
        function BitReadStream(buffer) {
            var offset = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;

            _classCallCheck(this, BitReadStream);

            this.nowBitsLength = 0;
            this.isEnd = false;
            this.buffer = buffer;
            this.bufferIndex = offset;
            this.nowBits = buffer[offset];
            this.nowBitsLength = 8;
        }

        _createClass(BitReadStream, [{
            key: 'read',
            value: function read() {
                if (this.isEnd) {
                    throw new Error('Lack of data length');
                }
                var bit = this.nowBits & 1;
                if (this.nowBitsLength > 1) {
                    this.nowBitsLength--;
                    this.nowBits >>= 1;
                } else {
                    this.bufferIndex++;
                    if (this.bufferIndex < this.buffer.length) {
                        this.nowBits = this.buffer[this.bufferIndex];
                        this.nowBitsLength = 8;
                    } else {
                        this.nowBitsLength = 0;
                        this.isEnd = true;
                    }
                }
                return bit;
            }
        }, {
            key: 'readRange',
            value: function readRange(length) {
                while (this.nowBitsLength <= length) {
                    this.nowBits |= this.buffer[++this.bufferIndex] << this.nowBitsLength;
                    this.nowBitsLength += 8;
                }
                var bits = this.nowBits & (1 << length) - 1;
                this.nowBits >>>= length;
                this.nowBitsLength -= length;
                return bits;
            }
        }, {
            key: 'readRangeCoded',
            value: function readRangeCoded(length) {
                var bits = 0;
                for (var i = 0; i < length; i++) {
                    bits <<= 1;
                    bits |= this.read();
                }
                return bits;
            }
        }]);

        return BitReadStream;
    }();

    var Uint8WriteStream = function () {
        function Uint8WriteStream(extendedSize) {
            _classCallCheck(this, Uint8WriteStream);

            this.index = 0;
            this.buffer = new Uint8Array(extendedSize);
            this.length = extendedSize;
            this._extendedSize = extendedSize;
        }

        _createClass(Uint8WriteStream, [{
            key: 'write',
            value: function write(value) {
                if (this.length <= this.index) {
                    this.length += this._extendedSize;
                    var newBuffer = new Uint8Array(this.length);
                    var nowSize = this.buffer.length;
                    for (var i = 0; i < nowSize; i++) {
                        newBuffer[i] = this.buffer[i];
                    }
                    this.buffer = newBuffer;
                }
                this.buffer[this.index] = value;
                this.index++;
            }
        }]);

        return Uint8WriteStream;
    }();

    var FIXED_HUFFMAN_TABLE = generateHuffmanTable(makeFixedHuffmanCodelenValues());
    function inflate(input) {
        var offset = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;

        var buffer = new Uint8WriteStream(input.length * 10);
        var stream = new BitReadStream(input, offset);
        var bFinal = 0;
        var bType = 0;
        while (bFinal !== 1) {
            bFinal = stream.readRange(1);
            bType = stream.readRange(2);
            if (bType === BTYPE.UNCOMPRESSED) {
                inflateUncompressedBlock(stream, buffer);
            } else if (bType === BTYPE.FIXED) {
                inflateFixedBlock(stream, buffer);
            } else if (bType === BTYPE.DYNAMIC) {
                inflateDynamicBlock(stream, buffer);
            } else {
                throw new Error('Not supported BTYPE : ' + bType);
            }
            if (bFinal === 0 && stream.isEnd) {
                throw new Error('Data length is insufficient');
            }
        }
        return buffer.buffer.subarray(0, buffer.index);
    }
    function inflateUncompressedBlock(stream, buffer) {
        // Skip to byte boundary
        if (stream.nowBitsLength < 8) {
            stream.readRange(stream.nowBitsLength);
        }
        var LEN = stream.readRange(8) | stream.readRange(8) << 8;
        var NLEN = stream.readRange(8) | stream.readRange(8) << 8;
        if (LEN + NLEN !== 65535) {
            throw new Error('Data is corrupted');
        }
        for (var i = 0; i < LEN; i++) {
            buffer.write(stream.readRange(8));
        }
    }
    function inflateFixedBlock(stream, buffer) {
        var tables = FIXED_HUFFMAN_TABLE;
        var codelens = Object.keys(tables);
        var codelen = 0;
        var codelenMax = 0;
        var codelenMin = Number.MAX_SAFE_INTEGER;
        codelens.forEach(function (key) {
            codelen = Number(key);
            if (codelenMax < codelen) {
                codelenMax = codelen;
            }
            if (codelenMin > codelen) {
                codelenMin = codelen;
            }
        });
        var code = 0;
        var value = void 0;
        var repeatLengthCode = void 0;
        var repeatLengthValue = void 0;
        var repeatLengthExt = void 0;
        var repeatDistanceCode = void 0;
        var repeatDistanceValue = void 0;
        var repeatDistanceExt = void 0;
        var repeatStartIndex = void 0;
        while (!stream.isEnd) {
            value = undefined;
            codelen = codelenMin;
            code = stream.readRangeCoded(codelenMin);
            while (true) {
                value = tables[codelen][code];
                if (value !== undefined) {
                    break;
                }
                if (codelenMax <= codelen) {
                    throw new Error('Data is corrupted');
                }
                codelen++;
                code <<= 1;
                code |= stream.read();
            }
            if (value < 256) {
                buffer.write(value);
                continue;
            }
            if (value === 256) {
                break;
            }
            repeatLengthCode = value - 257;
            repeatLengthValue = LENGTH_EXTRA_BIT_BASE[repeatLengthCode];
            repeatLengthExt = LENGTH_EXTRA_BIT_LEN[repeatLengthCode];
            if (0 < repeatLengthExt) {
                repeatLengthValue += stream.readRange(repeatLengthExt);
            }
            repeatDistanceCode = stream.readRangeCoded(5);
            repeatDistanceValue = DISTANCE_EXTRA_BIT_BASE[repeatDistanceCode];
            repeatDistanceExt = DISTANCE_EXTRA_BIT_LEN[repeatDistanceCode];
            if (0 < repeatDistanceExt) {
                repeatDistanceValue += stream.readRange(repeatDistanceExt);
            }
            repeatStartIndex = buffer.index - repeatDistanceValue;
            for (var i = 0; i < repeatLengthValue; i++) {
                buffer.write(buffer.buffer[repeatStartIndex + i]);
            }
        }
    }
    function inflateDynamicBlock(stream, buffer) {
        var HLIT = stream.readRange(5) + 257;
        var HDIST = stream.readRange(5) + 1;
        var HCLEN = stream.readRange(4) + 4;
        var codelenCodelen = 0;
        var codelenCodelenValues = {};
        for (var i = 0; i < HCLEN; i++) {
            codelenCodelen = stream.readRange(3);
            if (codelenCodelen === 0) {
                continue;
            }
            if (!codelenCodelenValues[codelenCodelen]) {
                codelenCodelenValues[codelenCodelen] = [];
            }
            codelenCodelenValues[codelenCodelen].push(CODELEN_VALUES[i]);
        }
        var codelenHuffmanTables = generateHuffmanTable(codelenCodelenValues);
        var codelenCodelens = Object.keys(codelenHuffmanTables);
        var codelenCodelenMax = 0;
        var codelenCodelenMin = Number.MAX_SAFE_INTEGER;
        codelenCodelens.forEach(function (key) {
            codelenCodelen = Number(key);
            if (codelenCodelenMax < codelenCodelen) {
                codelenCodelenMax = codelenCodelen;
            }
            if (codelenCodelenMin > codelenCodelen) {
                codelenCodelenMin = codelenCodelen;
            }
        });
        var dataCodelenValues = {};
        var distanceCodelenValues = {};
        var codelenCode = 0;
        var runlengthCode = void 0;
        var repeat = 0;
        var codelen = 0;
        var codesNumber = HLIT + HDIST;
        for (var _i9 = 0; _i9 < codesNumber;) {
            runlengthCode = undefined;
            codelenCodelen = codelenCodelenMin;
            codelenCode = stream.readRangeCoded(codelenCodelenMin);
            while (true) {
                runlengthCode = codelenHuffmanTables[codelenCodelen][codelenCode];
                if (runlengthCode !== undefined) {
                    break;
                }
                if (codelenCodelenMax <= codelenCodelen) {
                    throw new Error('Data is corrupted');
                }
                codelenCodelen++;
                codelenCode <<= 1;
                codelenCode |= stream.read();
            }
            if (runlengthCode === 16) {
                repeat = 3 + stream.readRange(2);
            } else if (runlengthCode === 17) {
                repeat = 3 + stream.readRange(3);
                codelen = 0;
            } else if (runlengthCode === 18) {
                repeat = 11 + stream.readRange(7);
                codelen = 0;
            } else {
                repeat = 1;
                codelen = runlengthCode;
            }
            if (codelen <= 0) {
                _i9 += repeat;
            } else {
                while (repeat) {
                    if (_i9 < HLIT) {
                        if (!dataCodelenValues[codelen]) {
                            dataCodelenValues[codelen] = [];
                        }
                        dataCodelenValues[codelen].push(_i9++);
                    } else {
                        if (!distanceCodelenValues[codelen]) {
                            distanceCodelenValues[codelen] = [];
                        }
                        distanceCodelenValues[codelen].push(_i9++ - HLIT);
                    }
                    repeat--;
                }
            }
        }
        var dataHuffmanTables = generateHuffmanTable(dataCodelenValues);
        var distanceHuffmanTables = generateHuffmanTable(distanceCodelenValues);
        var dataCodelens = Object.keys(dataHuffmanTables);
        var dataCodelen = 0;
        var dataCodelenMax = 0;
        var dataCodelenMin = Number.MAX_SAFE_INTEGER;
        dataCodelens.forEach(function (key) {
            dataCodelen = Number(key);
            if (dataCodelenMax < dataCodelen) {
                dataCodelenMax = dataCodelen;
            }
            if (dataCodelenMin > dataCodelen) {
                dataCodelenMin = dataCodelen;
            }
        });
        var distanceCodelens = Object.keys(distanceHuffmanTables);
        var distanceCodelen = 0;
        var distanceCodelenMax = 0;
        var distanceCodelenMin = Number.MAX_SAFE_INTEGER;
        distanceCodelens.forEach(function (key) {
            distanceCodelen = Number(key);
            if (distanceCodelenMax < distanceCodelen) {
                distanceCodelenMax = distanceCodelen;
            }
            if (distanceCodelenMin > distanceCodelen) {
                distanceCodelenMin = distanceCodelen;
            }
        });
        var dataCode = 0;
        var data = void 0;
        var repeatLengthCode = void 0;
        var repeatLengthValue = void 0;
        var repeatLengthExt = void 0;
        var repeatDistanceCode = void 0;
        var repeatDistanceValue = void 0;
        var repeatDistanceExt = void 0;
        var repeatDistanceCodeCodelen = void 0;
        var repeatDistanceCodeCode = void 0;
        var repeatStartIndex = void 0;
        while (!stream.isEnd) {
            data = undefined;
            dataCodelen = dataCodelenMin;
            dataCode = stream.readRangeCoded(dataCodelenMin);
            while (true) {
                data = dataHuffmanTables[dataCodelen][dataCode];
                if (data !== undefined) {
                    break;
                }
                if (dataCodelenMax <= dataCodelen) {
                    throw new Error('Data is corrupted');
                }
                dataCodelen++;
                dataCode <<= 1;
                dataCode |= stream.read();
            }
            if (data < 256) {
                buffer.write(data);
                continue;
            }
            if (data === 256) {
                break;
            }
            repeatLengthCode = data - 257;
            repeatLengthValue = LENGTH_EXTRA_BIT_BASE[repeatLengthCode];
            repeatLengthExt = LENGTH_EXTRA_BIT_LEN[repeatLengthCode];
            if (0 < repeatLengthExt) {
                repeatLengthValue += stream.readRange(repeatLengthExt);
            }
            repeatDistanceCode = undefined;
            repeatDistanceCodeCodelen = distanceCodelenMin;
            repeatDistanceCodeCode = stream.readRangeCoded(distanceCodelenMin);
            while (true) {
                repeatDistanceCode = distanceHuffmanTables[repeatDistanceCodeCodelen][repeatDistanceCodeCode];
                if (repeatDistanceCode !== undefined) {
                    break;
                }
                if (distanceCodelenMax <= repeatDistanceCodeCodelen) {
                    throw new Error('Data is corrupted');
                }
                repeatDistanceCodeCodelen++;
                repeatDistanceCodeCode <<= 1;
                repeatDistanceCodeCode |= stream.read();
            }
            repeatDistanceValue = DISTANCE_EXTRA_BIT_BASE[repeatDistanceCode];
            repeatDistanceExt = DISTANCE_EXTRA_BIT_LEN[repeatDistanceCode];
            if (0 < repeatDistanceExt) {
                repeatDistanceValue += stream.readRange(repeatDistanceExt);
            }
            repeatStartIndex = buffer.index - repeatDistanceValue;
            for (var _i10 = 0; _i10 < repeatLengthValue; _i10++) {
                buffer.write(buffer.buffer[repeatStartIndex + _i10]);
            }
        }
    }

    /**
     * @license Copyright (c) 2018 zprodev
     */
    function inflate$1(input) {
        var stream = new BitReadStream(input);
        var CM = stream.readRange(4);
        if (CM !== 8) {
            throw new Error('Not compressed by deflate');
        }
        var CINFO = stream.readRange(4);
        var FCHECK = stream.readRange(5);
        var FDICT = stream.readRange(1);
        var FLEVEL = stream.readRange(2);
        return inflate(input, 2);
    }
    function deflate$1(input) {
        var data = deflate(input);
        var CMF = new BitWriteStream(new Uint8Array(1));
        CMF.writeRange(8, 4);
        CMF.writeRange(7, 4);
        var FLG = new BitWriteStream(new Uint8Array(1));
        FLG.writeRange(28, 5);
        FLG.writeRange(0, 1);
        FLG.writeRange(2, 2);
        var ADLER32 = new BitWriteStream(new Uint8Array(4));
        var adler32 = calcAdler32(input);
        ADLER32.writeRange(adler32 >>> 24, 8);
        ADLER32.writeRange(adler32 >>> 16 & 0xff, 8);
        ADLER32.writeRange(adler32 >>> 8 & 0xff, 8);
        ADLER32.writeRange(adler32 & 0xff, 8);
        var output = new Uint8Array(data.length + 6);
        output.set(CMF.buffer);
        output.set(FLG.buffer, 1);
        output.set(data, 2);
        output.set(ADLER32.buffer, output.length - 4);
        return output;
    }

    exports.inflate = inflate$1;
    exports.deflate = deflate$1;

    return exports;
}({});

/***/ })

/******/ });