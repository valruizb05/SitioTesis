<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experimentation; // Importar el modelo Experimentation
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    
    public function showQuiz($filename)
    {
        $userId = Auth::id();
    $experimentation = Experimentation::where('user_id', $userId)->first();

    if (!$experimentation) {
        return redirect()->route('index')->withErrors('No se encontró información de experimentación.');
    }

    $categoryId = $experimentation->asignature_id;

    // Mapeo de categorías por ID
    $categories = [
        1 => 'biologia',
        2 => 'geografia',
        3 => 'historia',
        // Agrega más categorías según sea necesario
    ];

    $category = $categories[$categoryId] ?? 'unknown'; // Recupera el nombre de la categoría o 'unknown'

        // Define los cuestionarios
        $quizzes = [
            'AparatoRespiratorio' => [
                ['question' => '¿Cuál es la función principal de los cilios en la tráquea?', 'options' => ['Transportar oxígeno a los alvéolos.', 'Mantener la mucosidad y la suciedad fuera de los pulmones.', 'Facilitar la exhalación del aire viciado.'], 'correct' => 1],
                ['question' => '¿Por qué el pulmón izquierdo es más pequeño que el derecho?', 'options' => ['Porque contiene más alvéolos.', 'Porque necesita acomodar espacio para el corazón.', 'Porque tiene menos bronquiolos que el derecho.'], 'correct' => 1],
                ['question' => '¿Qué sucede en los alvéolos durante la respiración?', 'options' => ['El oxígeno pasa a los capilares y el dióxido de carbono es expulsado a la sangre.', 'Los bronquiolos se expanden para permitir mayor flujo de aire.', 'Se recoge calor para regular la temperatura del aire exhalado.'], 'correct' => 0],
                ['question' => '¿Cómo afecta el humo del cigarrillo el funcionamiento normal de los pulmones?', 'options' => ['Interfiere con el movimiento de los cilios, lo que permite la acumulación de suciedad y sustancias nocivas.', 'Aumenta la elasticidad de los alvéolos, permitiendo una mayor capacidad de oxigenación.', 'Reduce el esfuerzo del diafragma, facilitando la respiración.'], 'correct' => 0],
                ['question' => '¿Qué permite que las membranas pleurales eviten que los pulmones se "atasquen" al respirar?', 'options' => ['El líquido entre ellas facilita que se deslicen.', 'La presión constante ejercida por el diafragma.', 'La cantidad de aire que fluye a través de la tráquea.'], 'correct' => 0],
            ],
            'Ecologia' => [
                ['question' => '¿Qué factores son considerados en el estudio de la ecología?', 'options' => ['Únicamente los factores bióticos, como los seres vivos.', 'Los factores bióticos y abióticos, como el clima y el suelo.', 'Los factores climáticos y geológicos exclusivamente.'],'correct' => 1],
                ['question' => '¿Cuál es el origen del término "ecología"?', 'options' => ['Proviene del latín "eco" (hogar) y "logia" (estudio).', 'Fue acuñado por Aristóteles en sus estudios sobre la botánica.','Deriva del griego "oikos" (hogar) y "logos" (estudio), creado por Ernst Haeckel.' ],'correct' => 2],
                ['question' => '¿Qué distingue la ecología de las poblaciones de la ecología de las comunidades?', 'options' => ['La ecología de las poblaciones estudia diferentes especies, mientras que la de comunidades se enfoca en una sola especie.', 'La ecología de las poblaciones analiza seres vivos de una misma especie, mientras que la de comunidades estudia la interacción entre diferentes especies.', 'La ecología de las poblaciones abarca todos los niveles de organización, mientras que la de comunidades se limita a un área específica.'],'correct' => 1],
                ['question' => '¿Cuál es uno de los principales objetivos del ecologismo?', 'options' => ['Desarrollar leyes que fomenten el uso exclusivo de transporte público.', 'Promover la preservación del medio ambiente y el equilibrio entre el ser humano y los ecosistemas.','Garantizar que todos los Estados adopten un sistema único de reciclaje.'], 'correct' => 1],
                ['question' => '¿Por qué es importante la ecología evolutiva?','options' => ['Porque permite evaluar cómo los paisajes afectan a las especies en tiempo real.', 'Porque estudia las transformaciones y cambios en una población a lo largo del tiempo.','Porque analiza las relaciones entre el ser humano y su entorno social.'], 'correct' => 1]
            ],
            'Genetica' => [
                ['question' => '¿Qué función cumplen los genes en el organismo?','options' => ['Generan las células reproductoras y controlan su división.', 'Almacenan información y contienen las instrucciones para formar proteínas.', 'Se encargan exclusivamente del crecimiento de los músculos.'],'correct' => 1],
                ['question' => '¿Qué diferencia existe entre el genotipo y el fenotipo?', 'options' => ['El genotipo es visible, mientras que el fenotipo corresponde a las características heredadas exclusivamente del padre.', 'El genotipo es el conjunto de información genética transmisible, mientras que el fenotipo es la manifestación física o conductual resultante.', 'No hay diferencias, ambos términos se refieren a las características visibles del individuo.'],'correct' => 1],
                ['question' => '¿Cómo se define la herencia dominante-recesiva?','options' => ['Es cuando ambos alelos se mezclan y generan un rasgo intermedio.', 'Ocurre cuando un alelo domina sobre otro y su rasgo se manifiesta en la descendencia.', 'Es cuando los alelos están ligados al sexo y solo se heredan de la madre.'],'correct' => 1 ],
                ['question' => '¿Qué caracteriza a la herencia ligada al sexo?','options' => ['Los hombres solo pueden pasar su cromosoma Y a sus hijos varones.', 'Las mujeres pueden transmitir tanto el cromosoma X como el cromosoma Y.', 'Los padres heredan los mismos rasgos ligados al sexo a hijos e hijas por igual.'],'correct' => 0],
                ['question' => '¿Cuál es el objetivo principal de la manipulación genética?','options' => ['Aumentar la variabilidad genética dentro de una población.', 'Modificar las características hereditarias de un organismo, aislando y clonando genes específicos.', 'Reducir las mutaciones genéticas en los organismos vivos.'],'correct' => 1]
            ],
            'SistemaInmunologico' => [
                ['question' => '¿Cuál es el propósito principal del sistema inmunológico?', 'options' => ['Mantener el flujo sanguíneo estable.', 'Proteger al cuerpo de microorganismos infecciosos y destruirlos si invaden.', 'Aumentar la producción de glóbulos rojos.'], 'correct' => 1],
                ['question' => '¿Qué distingue a las células "B" de las células "T"?', 'options' => ['Las células "B" destruyen células infectadas, mientras que las células "T" producen anticuerpos.', 'Las células "B" producen anticuerpos, mientras que las células "T" destruyen microorganismos y células infectadas.', 'Ambas células cumplen la misma función, pero en órganos distintos.'], 'correct' => 1],
                ['question' => '¿Qué caracteriza a la inmunidad adquirida?', 'options' => ['Es transmitida de la madre al hijo a través de la placenta.', 'Se desarrolla por exposición a microorganismos específicos o vacunas, y puede "recordar" futuras infecciones.', 'Es una barrera natural como la piel o las mucosas.'], 'correct' => 1],
                ['question' => '¿Cómo actúan los antibióticos frente a las infecciones?', 'options' => ['Eliminar tanto virus como bacterias por igual.', 'Combaten infecciones bacterianas, pero son ineficaces contra infecciones virales.', 'Destruyen cualquier microorganismo en el cuerpo, incluyendo hongos y parásitos.'], 'correct' => 1],
                ['question' => '¿Qué distingue a los virus de las bacterias en las enfermedades infecciosas?', 'options' => ['Los virus causan infecciones en el tracto urinario, mientras que las bacterias provocan resfriados comunes.', 'Los virus causan la mayoría de los resfriados y gripes, mientras que las bacterias son responsables de infecciones como la faringitis estreptocócica.', 'Ambos actúan de la misma manera y son tratados con los mismos medicamentos.'], 'correct' => 1],
            ],
            'Cartografia' => [
                ['question' => '¿Cuál es el propósito principal de la cartografía?', 'options' => ['Representar gráficamente un área geográfica utilizando convenciones específicas.', 'Dividir el mundo en hemisferios para facilitar su estudio.', 'Describir los fenómenos climáticos en distintas regiones del planeta.'], 'correct' => 0],
                ['question' => '¿Qué caracteriza a la cartografía temática?', 'options' => ['Representa aspectos generales de la geografía, como los mapamundis.', 'Se enfoca en aspectos específicos como la economía, agricultura o fenómenos militares.', 'Crea mapas basados exclusivamente en representaciones digitales.'], 'correct' => 1],
                ['question' => '¿Cuál fue uno de los avances clave que permitió mayor precisión en los mapas durante los siglos XV al XVII?', 'options' => ['La invención de la imprenta y el telescopio.', 'El desarrollo de sistemas de coordenadas digitales.', 'La aparición de los sistemas de posicionamiento global.'], 'correct' => 0],
                ['question' => '¿Qué función cumplen los paralelos y meridianos en la cartografía?', 'options' => ['Sirven únicamente para dividir las regiones climáticas del mundo.', 'Permiten crear una cuadrícula que facilita la ubicación de puntos en el planeta mediante coordenadas.', 'Representan los límites políticos entre países y continentes.'], 'correct' => 1],
                ['question' => '¿Qué distingue a la cartografía social de la cartografía tradicional?', 'options' => ['Utiliza únicamente herramientas digitales y satelitales para elaborar mapas.', 'Busca un enfoque colectivo y participativo en la elaboración de mapas, evitando criterios subjetivos tradicionales.', 'Se centra exclusivamente en aspectos políticos y culturales de cada región.'], 'correct' => 1],
            ],
            'DesastresNaturales' => [
                ['question' => '¿Qué es un desastre natural?', 'options' => ['Cualquier evento catastrófico que ocurre en la naturaleza, afectando o no a las personas.', 'Un evento catastrófico causado por procesos naturales que afecta a zonas pobladas.', 'Cualquier fenómeno natural que incluye animales y plantas.'], 'correct' => 1],
                ['question' => '¿Cuál de los siguientes no es un tipo de desastre natural?', 'options' => ['Desastres biológicos como epidemias o mareas rojas.', 'Desastres geofísicos como terremotos o erupciones volcánicas.', 'Desastres económicos causados por la falta de recursos en una región.'], 'correct' => 2],
                ['question' => '¿Cómo influye la densidad de población en los desastres naturales?', 'options' => ['A mayor densidad de población, mayor es la probabilidad de predecir un desastre.', 'A mayor densidad de población, mayores son las pérdidas humanas y materiales en un desastre.', 'La densidad de población no influye en el impacto de los desastres naturales.'], 'correct' => 1],
                ['question' => '¿Qué acciones pueden tomarse para prevenir el impacto de desastres como deslaves y deslizamientos?', 'options' => ['Construir viviendas en zonas con pendiente pronunciada.', 'Implementar barreras de contención y controlar la deforestación desmedida.', 'Aumentar la densidad de población en las zonas cercanas a montañas.'], 'correct' => 1],
                ['question' => '¿Qué caracteriza a los desastres naturales meteorológicos?', 'options' => ['Surgen exclusivamente de actividades humanas relacionadas con el clima.', 'Están relacionados con fenómenos climáticos y pueden predecirse con tecnología moderna.', 'Se originan en los océanos y afectan solo a zonas costeras.'], 'correct' => 1],
            ],
            'MedioAmbiente' => [
                ['question' => '¿Qué elementos conforman el medio ambiente?', 'options' => ['Solo factores bióticos y abióticos.', 'Factores bióticos, abióticos y elementos artificiales creados por el hombre.', 'Solo los factores creados por el ser humano, como la urbanización.'], 'correct' => 1],
                ['question' => '¿Cuál es la importancia de los factores abióticos en el medio ambiente?', 'options' => ['Son responsables únicamente de la contaminación ambiental.', 'Determinan el espacio físico del ambiente y son esenciales para la subsistencia de los seres vivos.', 'Son menos importantes que los factores bióticos para el equilibrio ecológico.'], 'correct' => 1],
                ['question' => '¿Qué impacto tuvo la Revolución Industrial en el medio ambiente?', 'options' => ['Aumentó el equilibrio ambiental debido a avances tecnológicos.', 'Provocó un incremento de la contaminación y la pérdida del equilibrio ambiental.', 'Redujo la tala indiscriminada y fomentó la biodiversidad.'], 'correct' => 1],
                ['question' => '¿Cuál es una de las principales causas de la contaminación del agua?', 'options' => ['El uso de pesticidas en la agricultura.', 'Los desechos industriales y domésticos arrojados a ríos y mares.', 'La liberación de gases por los automóviles.'], 'correct' => 1],
                ['question' => '¿Qué medidas pueden tomarse desde los hogares para cuidar el medio ambiente?', 'options' => ['Incrementar el uso de envoltorios plásticos para reciclar más.', 'Separar los residuos, reutilizar envases y reducir el uso de agua y energía.', 'Evitar el uso de transporte público para reducir la contaminación.'], 'correct' => 1],
            ],
            'SeresVivos' => [
                ['question' => '¿Qué característica comparten tanto plantas como animales?', 'options' => ['Poseen células procariotas con orgánulos especializados.', 'Necesitan agua, nutrientes y luz solar para sobrevivir.', 'Tienen sistemas digestivos y de locomoción para su nutrición.'], 'correct' => 1],
                ['question' => '¿Cuál es una diferencia clave entre las células animales y vegetales?', 'options' => ['Las células animales tienen paredes celulares rígidas, mientras que las vegetales no.', 'Las células vegetales tienen cloroplastos y paredes celulares, mientras que las animales no.', 'Ambas tienen la misma estructura y función.'], 'correct' => 1],
                ['question' => '¿Por qué las plantas no necesitan aparatos digestivos o excretores?', 'options' => ['Porque absorben nutrientes y agua directamente del aire.', 'Porque son autótrofas y fabrican su propio alimento mediante la fotosíntesis.', 'Porque no realizan funciones metabólicas complejas.'], 'correct' => 1],
                ['question' => '¿Cómo se diferencia el crecimiento de las plantas del de los animales?', 'options' => ['Las plantas tienen un crecimiento ilimitado, mientras que los animales crecen hasta un tamaño determinado por su genética.', 'Los animales pueden crecer ilimitadamente, mientras que las plantas tienen un límite.', 'Ambos tienen un crecimiento ilimitado dependiendo de su entorno.'], 'correct' => 0],
                ['question' => '¿Qué tipo de reproducción es más común en las plantas pero rara en los animales?', 'options' => ['La reproducción sexual con variabilidad genética.', 'La reproducción asexual, en la que se generan descendientes idénticos al progenitor.', 'La reproducción mediante gametos en un sistema social complejo.'], 'correct' => 1],
            ],
            'Conquista' => [
                ['question' => '¿En qué fecha los españoles lograron capturar Tenochtitlán, marcando el fin del Imperio azteca?', 'options' => ['13 de agosto de 1521', '30 de junio de 1520', '15 de septiembre de 1519'], 'correct' => 0],
                ['question' => '¿Qué estrategia utilizó Hernán Cortés para evitar la deserción de su tropa?', 'options' => ['Les ofrecieron tierras y riquezas para motivarlos.', 'Destruyó sus barcos para impedir que regresaran a Cuba.', 'Incorporó soldados tlaxcaltecas para reforzar la moral del grupo.'], 'correct' => 1],
                ['question' => '¿Qué factor favoreció a los españoles durante el asentamiento de Tenochtitlán?', 'options' => ['La llegada de refuerzos europeos.', 'La epidemia de viruela que diezmó a la población mexicana.', 'La falta de armas de los mexicas para enfrentar a los españoles.'], 'correct' => 1],
                ['question' => '¿Qué papel ayudó “la Malinche” durante la conquista?', 'options' => ['Fue un líder militar en la batalla contra los mexicas.', 'Actuó como intérprete, consejera y enlace entre Cortés y los pueblos indígenas.', 'Fue gobernadora de Tlaxcala tras la conquista.'], 'correct' => 1],
                ['question' => '¿Quién lideró a los mexicas en su última defensa contra los españoles durante el asalto a Tenochtitlán?', 'options' => ['Cuauhtémoc', 'Cuitláhuac', 'Moctezuma'], 'correct' => 0],
            ],
            'EdadAntigua' => [
                ['question' => '¿En qué fecha los españoles lograron capturar Tenochtitlán, marcando el fin del Imperio azteca?', 'options' => ['13 de agosto de 1521', '30 de junio de 1520', '15 de septiembre de 1519'], 'correct' => 0],
                ['question' => '¿Qué estrategia utilizó Hernán Cortés para evitar la deserción de su tropa?', 'options' => ['Les ofrecieron tierras y riquezas para motivarlos.', 'Destruyó sus barcos para impedir que regresaran a Cuba.', 'Incorporó soldados tlaxcaltecas para reforzar la moral del grupo.'], 'correct' => 1],
                ['question' => '¿Qué factor favoreció a los españoles durante el asentamiento de Tenochtitlán?', 'options' => ['La llegada de refuerzos europeos.', 'La epidemia de viruela que diezmó a la población mexicana.', 'La falta de armas de los mexicas para enfrentar a los españoles.'], 'correct' => 1],
                ['question' => '¿Qué papel ayudó “la Malinche” durante la conquista?', 'options' => ['Fue un líder militar en la batalla contra los mexicas.', 'Actuó como intérprete, consejera y enlace entre Cortés y los pueblos indígenas.', 'Fue gobernadora de Tlaxcala tras la conquista.'], 'correct' => 1],
                ['question' => '¿Quién lideró a los mexicas en su última defensa contra los españoles durante el asalto a Tenochtitlán?', 'options' => ['Cuauhtémoc', 'Cuitláhuac', 'Moctezuma'], 'correct' => 0],
            ],
            'GuerraFria' => [
                ['question' => '¿Qué caracterizó a la Guerra Fría como un conflicto?', 'options' => ['Enfrentamientos militares directos entre la URSS y EE. UU.', 'Disputas diplomáticas, guerras subsidiarias y una carrera armamentística y espacial.', 'Una alianza estratégica entre potencias capitalistas y comunistas.'], 'correct' => 1],
                ['question' => '¿Cuál fue el término usado por Churchill en 1946 para describir la división de Europa?', 'options' => ['La cortina de hierro.', 'El telón de acero.', 'La barrera soviética.'], 'correct' => 1],
                ['question' => '¿Qué bloque impulsó la creación de la OTAN?', 'options' => ['El bloque oriental, liderado por la URSS.', 'El bloque occidental, liderado por Estados Unidos.', 'Los países no alineados.'], 'correct' => 1],
                ['question' => '¿Qué suceso estuvo relacionado con la amenaza de una guerra nuclear durante la Guerra Fría?', 'options' => ['La construcción del muro de Berlín.', 'La crisis de los misiles en Cuba.', 'La caída del Muro de Berlín.'], 'correct' => 1],
                ['question' => '¿Qué hecho marcó el final formal de la Guerra Fría en 1991?', 'options' => ['La firma de la Doctrina Truman.', 'La caída de la Unión Soviética.', 'La victoria de Estados Unidos en Vietnam.'], 'correct' => 1],
            ],
            'Pasteles' => [
                    ['question' => '¿Qué evento desencadenó la Guerra de los Pasteles en 1838?', 'options' => ['La negativa de México a negociar rutas comerciales con Francia.', 'La deuda de 600,000 pesos exigida por Francia.', 'El reclamo de un pastelero francés por impagos y destrozos en su negocio.'], 'correct' => 2],
                    ['question' => '¿Qué acción tomó Antonio López de Santa Anna durante la Guerra de los Pasteles?', 'options' => ['Ordenó la rendición inmediata del puerto de Veracruz.', 'Lideró las tropas mexicanas para intentar expulsar a los franceses.', 'Negoció directamente con el contraalmirante Charles Baudin.'], 'correct' => 1],
                    ['question' => '¿Qué resultado tuvo el conflicto conocido como la Guerra de los Pasteles?', 'options' => ['México logró expulsar a las tropas francesas sin pagar la indemnización.', 'México tuvo que pagar una indemnización parcial a Francia.', 'Francia estableció un control permanente sobre Veracruz.'], 'correct' => 1],
                    ['question' => '¿Cuál fue la consecuencia de la herida sufrida por Santa Anna durante la batalla en Veracruz?', 'options' => ['Murió a los pocos días por complicaciones.', 'Perdió una pierna, la cual fue sepultada con honores.', 'Fue capturado por las tropas francesas.'], 'correct' => 1],
                    ['question' => '¿Qué país intervino para mediar en el acuerdo de paz entre México y Francia al finalizar la Guerra de los Pasteles?', 'options' => ['España.', 'Gran Bretaña.', 'Estados Unidos.'], 'correct' => 1],
            ]
        ];

        // Obtiene el cuestionario correspondiente al texto seleccionado
         $quiz = $quizzes[$filename] ?? null;

    if (!$quiz) {
        return redirect()->route('index')->withErrors('No se encontró un cuestionario para este texto.');
    }

    return view('quiz', [
        'quiz' => $quiz,
        'filename' => $filename,
        'category' => $category, // Pasa la categoría a la vista
    ]);
    }


    public function submitQuiz(Request $request, $filename)
    {

        $userAnswers = $request->input('answers');
        if (!$userAnswers) {
            return response()->json([
                'success' => false,
                'message' => 'No se recibieron respuestas.',
            ]);
        }
    
        // Log para depuración (puedes quitarlo después)
        Log::info('Respuestas recibidas: ', $userAnswers);


        // Define los cuestionarios
        $quizzes = [
            'AparatoRespiratorio' => [
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 0],
                ['correct' => 0],
                ['correct' => 0],
            ],
            'Ecologia' => [
                ['correct' => 1],
                ['correct' => 2],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
            ],
            'Genetica' => [
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 0],
                ['correct' => 1],
            ],
            'SistemaInmunologico' => [
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
            ],
            'Cartografia' => [
                ['correct' => 0],
                ['correct' => 1],
                ['correct' => 0],
                ['correct' => 1],
                ['correct' => 1],
            ],
            'DesastresNaturales' => [
                ['correct' => 1],
                ['correct' => 2],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
            ],
            'MedioAmbiente' => [
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
            ],
            'SeresVivos' => [
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 0],
                ['correct' => 1],
            ],
            'Conquista' => [
                ['correct' => 0],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 0],
            ],
            
            'EdadAntigua' => [
                ['correct' => 0],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 0],
            ],
            'GuerraFria' => [
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
            ],
            'Pasteles' => [
                ['correct' => 2],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
                ['correct' => 1],
            ],
        ];

        $quiz = $quizzes[$filename] ?? null;

    if (!$quiz) {
        return response()->json([
            'success' => false,
            'message' => 'Cuestionario no encontrado.',
        ]);
    }

    // Procesar las respuestas del usuario
    $results = [];
    foreach ($quiz as $index => $question) {
        $results[$index] = isset($userAnswers[$index]) && $userAnswers[$index] == $question['correct'] ? 1 : 0;
    }

    // Guardar las respuestas en columnas separadas
    $userId = Auth::id();
    $experimentation = Experimentation::where('user_id', $userId)->first();

    if (!$experimentation) {
        return response()->json([
            'success' => false,
            'message' => 'No se encontró información de experimentación.',
        ]);
    }

    $experimentation->question1 = $results[0] ?? null;
    $experimentation->question2 = $results[1] ?? null;
    $experimentation->question3 = $results[2] ?? null;
    $experimentation->question4 = $results[3] ?? null;
    $experimentation->question5 = $results[4] ?? null;
    $experimentation->save();

    // Determinar el tipo de texto siguiente
    $currentTextType = $experimentation->type_text; // 1: Humorístico, 2: Original
    $nextTextType = $currentTextType == 1 ? 'original' : 'humor';

    // Mapear la categoría usando el ID de asignatura
    $categories = [
        1 => 'biologia',
        2 => 'geografia',
        3 => 'historia',
        // Agrega más categorías según sea necesario
    ];
    $categoryId = $experimentation->asignature_id;
    $category = $categories[$categoryId] ?? 'unknown';

    // Responder con datos para redirigir
    return response()->json([
        'success' => true,
        'message' => 'Has completado el cuestionario.',
        'nextTextType' => $nextTextType,
        'category' => $category,
        'filename' => $filename,
    ]);
    }


    public function saveEvaluation(Request $request)
{
    // Validar los datos recibidos
    $validated = $request->validate([
        'humorRating' => 'required|integer|min:1|max:5',
        'compressionRating' => 'required|integer|min:1|max:5',
        'preference' => 'required|string|in:humor,original',
    ]);

    // Guardar los datos en la base de datos
    $userId = Auth::id();
    $experimentation = Experimentation::where('user_id', $userId)->first();

    if (!$experimentation) {
        return response()->json([
            'success' => false,
            'message' => 'No se encontró información de experimentación.',
        ], 404);
    }

    $experimentation->humoristic = $validated['humorRating'];
    $experimentation->compression = $validated['compressionRating'];
    $experimentation->preference = $validated['preference'];
    $experimentation->save();

    return response()->json([
        'success' => true,
    ]);
}




    // Métodos para obtener texto con humor o texto original
    private function getHumoristicText($filename)
    {
        // Tu lógica para obtener el texto con humor (archivo o base de datos)
        return "Contenido humorístico para {$filename}";
    }

    private function getOriginalText($filename)
    {
        // Tu lógica para obtener el texto original (archivo o base de datos)
        return "Contenido original para {$filename}";
    }

}
