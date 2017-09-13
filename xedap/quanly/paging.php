<?php
class Pagination
{	
	public $_config = array(
        'current_page'  => 1, 
        'total_record'  => 1, 
        'total_page'    => 1,
        'limit'         => 10,
        'start'         => 0, 
        'link_full'     => '',
        'link_first'    => '',
        'range'         => 9, 
        'min'           => 0, 
        'max'           => 0
    );
    function init($config = array())
    {
        foreach ($config as $key => $val){
            if (isset($this->_config[$key])){
                $this->_config[$key] = $val;
            }
        }
        if ($this->_config['limit'] < 0){
            $this->_config['limit'] = 0;
        }
        $this->_config['total_page'] = ceil($this->_config['total_record'] / $this->_config['limit']);
        if (!$this->_config['total_page']){
            $this->_config['total_page'] = 1;
        }
        if ($this->_config['current_page'] < 1){
            $this->_config['current_page'] = 1;
        }
         
        if ($this->_config['current_page'] > $this->_config['total_page']){
            $this->_config['current_page'] = $this->_config['total_page'];
        }
        $this->_config['start'] = ($this->_config['current_page'] - 1) * $this->_config['limit'];
        $middle = ceil($this->_config['range'] / 2);
        if ($this->_config['total_page'] < $this->_config['range']){
            $this->_config['min'] = 1;
            $this->_config['max'] = $this->_config['total_page'];
        }
        else
        {
            $this->_config['min'] = $this->_config['current_page'] - $middle + 1;
            $this->_config['max'] = $this->_config['current_page'] + $middle - 1;
            if ($this->_config['min'] < 1){
                $this->_config['min'] = 1;
                $this->_config['max'] = $this->_config['range'];
            }
            else if ($this->_config['max'] > $this->_config['total_page']) 
            {
                $this->_config['max'] = $this->_config['total_page'];
                $this->_config['min'] = $this->_config['total_page'] - $this->_config['range'] + 1;
            }
        }
    }
    private function __link($page)
    {
        if ($page <= 1 && $this->_config['link_first']){
            return $this->_config['link_first'];
        }
        return str_replace('{page}', $page, $this->_config['link_full']);
    }
    function html()
    {   
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit'])
        {
            $p = '<ul class="pagination">';
            if ($this->_config['current_page'] > 1)
            {
                $p .= '<li><a href="'.$this->__link('1').'">First</a></li>';
                $p .= '<li><a href="'.$this->__link($this->_config['current_page']-1).'">Prev</a></li>';
            }
            for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++)
            {
                if ($this->_config['current_page'] == $i){
                    $p .= '<li><span>'.$i.'</span></li>';
                }
                else{
                    $p .= '<li><a href="'.$this->__link($i).'">'.$i.'</a></li>';
                }
            }
            if ($this->_config['current_page'] < $this->_config['total_page'])
            {
                $p .= '<li><a href="'.$this->__link($this->_config['current_page'] + 1).'">Next</a></li>';
                $p .= '<li><a href="'.$this->__link($this->_config['total_page']).'">Last</a></li>';
            }
             
            $p .= '</ul>';
        }
        return $p;
    }
}
function get_km($conn,$id)
{
	$result = mysqli_query($conn, "select count(id) as total from khuyenmai where sanpham='$id'");
	$row = mysqli_fetch_assoc($result);
	$total_records = $row['total'];
	return $total_records;
}
?>