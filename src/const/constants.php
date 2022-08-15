<?php

const NOT_FOUND_CODE = 404;
const SUCCESS_CODE = 200;
const INTERNAL_SERVER_ERROR_CODE = 500;

const GET_ADS_PATTERN = '/adsapi/ads/(\d+)(\?(((isPriceSort=(1|0|(-1))&)|(isTimeSort=(1|0|(-1))&)|(perPage=(\d+)&)){0,2}((isPriceSort=(1|0|(-1)))|(isTimeSort=(1|0|(-1)))|(perPage=(\d+)))))?';
const ADD_AD_PATTERN = '/adsapi/add';
const GET_COUNT_PATTERN = '/adsapi/count';
const GET_AD_PATTERN = '/adsapi/ad/(\d+)(\?((fields\[\]=text&)|(fields\[\]=images&))?((fields\[\]=text)|(fields\[\]=images)))?';