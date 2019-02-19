DatasetCrawler Component
====================

Component to easy create data sets from provider urls. It uses DomCrawler symfony component.
Just create a DatasetCrawler instance class to collect data sets e.g.

```
# MyDatasetCrawler

use Webostin\Component\DatasetCrawler\Type\MetaTitleType;
use Webostin\Component\DatasetCrawler\AbstractCrawler;
use Webostin\Component\DatasetCrawler\Builder;


class MyDatasetCrawler extends AbstractCrawler {
    
    protected function buildAttributes(Builder $builder){
        $builder
            ->add('page_title', MetaTitleType::class); 
    }
}

# usage

$data = $myDatasetCrawler->createDataset('https://github.com');

# returns array('page_title'=>'GitHub')

```

