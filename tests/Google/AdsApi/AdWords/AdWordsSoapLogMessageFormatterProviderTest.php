<?php
/**
 * Copyright 2016 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace Google\AdsApi\AdWords;

use Google\AdsApi\Common\Testing\FakeSoapPayloadsAndLogsProvider;
use PHPUnit_Framework_TestCase;

/**
 * Unit tests for `AdWordsSoapLogMessageFormatterProvider`.
 *
 * @see AdWordsSoapLogMessageFormatterProvider
 * @small
 */
class AdWordsSoapLogMessageFormatterProviderTest
    extends PHPUnit_Framework_TestCase {

  private $adWordsSoapLogMessageFormatter;
  private $requestHttpHeadersMock;
  private $requestSoapXmlMock;
  private $responseSoapXmlMock;

  /**
   * @see PHPUnit_Framework_TestCase::setUp
   */
  protected function setUp() {
    $this->adWordsSoapLogMessageFormatter =
        (new AdWordsSoapLogMessageFormatterProvider())
            ->getSoapLogMessageFormatter();
    $this->requestHttpHeadersMock = FakeSoapPayloadsAndLogsProvider
        ::getFakeGetCreativesRequestHttpHeaders();
    $this->requestSoapXmlMock = FakeSoapPayloadsAndLogsProvider
        ::getFakeGetCreativesRequest();
    $this->responseSoapXmlMock = FakeSoapPayloadsAndLogsProvider
        ::getFakeGetCreativesResponse();
  }

  /**
   * @covers Google\AdsApi\AdWords\AdWordsSoapLogMessageFormatterProvider::getSoapLogMessageFormatter
   */
  public function testGetSoapLogMessageFormatterFormatsSummaryWithCCIdAndOps() {
    $this->assertSame(
        'clientCustomerId=123-777-999 operations=9 service=CreativeService '
            . 'method=getCreativesByStatement responseTime=226 '
            . 'requestId=123abc456xyz server=ads.google.com isFault=0 '
            . 'faultMessage=',
        $this->adWordsSoapLogMessageFormatter->formatSummary(
            'CreativeService',
            'getCreativesByStatement',
            $this->requestHttpHeadersMock,
            $this->requestSoapXmlMock,
            $this->responseSoapXmlMock
        )
    );
  }
}
