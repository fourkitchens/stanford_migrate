<?php

namespace Drupal\Tests\stanford_migrate\Unit\Plulgin\migrate\process;

use Drupal\stanford_migrate\Plugin\migrate\process\SubProcess as StanfordSubProcess;
use Drupal\migrate\MigrateExecutable;
use Drupal\migrate\Plugin\migrate\process\SubProcess as OrigSubProcess;
use Drupal\migrate\Row;
use Drupal\Tests\UnitTestCase;

/**
 * Class SubProcessTest.
 *
 * @group stanford_migrate
 * @coversDefaultClass \Drupal\stanford_migrate\Plugin\migrate\process\SubProcess
 */
class SubProcessTest extends UnitTestCase {

  public function testTranform() {
    $configuration = [
      'key' => 'newkey',
      'process' => [],
    ];
    $definition = [];
    $stanford_plugin = new StanfordSubProcess($configuration, 'sub_process', $definition);
    $original_plugin = new OrigSubProcess($configuration, 'sub_process', $definition);

    $migrate_executable = $this->createMock(MigrateExecutable::class);
    $row = $this->createMock(Row::class);

    $value = simplexml_load_string('<data><item1><newkey>akey</newkey></item1></data>');
    $new_value = $stanford_plugin->transform($value, $migrate_executable, $row, 'field_foo');
    $this->assertArrayEquals(['' => []], $new_value);
    $this->expectException(\Error::class);
    $original_plugin->transform($value, $migrate_executable, $row, 'field_foo');
  }

}
