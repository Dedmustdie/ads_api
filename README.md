# ads_api
Сервис для работы с объявлениями.
<h3>Методы:</h3>
<ul>
  <li>GET: /adsapi/ads/{<strong>pageNumber</strong>}?isPriceSort={<strong>sortDirection</strong>}&isTimeSort={<strong>sortDirection</strong>} - 
  получить список объявлений. 
  <ul>
    <li>pageNumber - номер страницы объявлений. </li>
    <li>sortDirection - направление сортировки (-1 - DESC, 0 - без сортировки, 1 - ASC)</li>
  </ul>
  </li>
  
  <li>POST: /adsapi/add - добавить объявление. Тело запроса:  
  <ul>
    <li>title - заголовок объявления</li>
    <li>text - текст объявления</li>
    <li>images - названия изображений объявления</li>
  </ul></li>
  <li>GET: /adsapi/count - получить суммарное количество объявлений.</li>
  
  <li>GET: /adsapi/ad/{<strong>id</strong>}?fields[]={<strong>additionalField</strong>}&fields[]={<strong>additionalField</strong>} - получить объявление.
  <ul>
    <li>id - идентификатор объявления</li>
    <li>additionalField - дополнительные компоненты объявления (text - текст объявления,  images - изображения объявления) </li>
  </ul></li>
  </li>
</ul>
