import { useEffect, useState } from "react";
import '../css/loader.css';

// Main application component
export default function App(){
    const [selectedPaintingID,setSelectedPaintingID] = useState(null);

    // function to store Painting ID in state
    function handlePaintingSelection(paintingID) {
        console.log("Painting ID to fetch:", paintingID);
        setSelectedPaintingID(paintingID);
    }

    // function to clear Painting ID from state
    function handleGoingBack() {
        setSelectedPaintingID(null);
    }
    

    return (
        <>
            <div className="custom-bg-dark-gray min-h-screen text-white custom-main-font">
                    <Header />
                    <main className="mb-8 px-2 md:container md:mx-auto">
                        {
                        selectedPaintingID
                        ? <PaintingPage
                            selectedPaintingID={selectedPaintingID}
                            handlePaintingSelection={handlePaintingSelection} 
                            handleGoingBack={handleGoingBack}
                        />
                        : <Homepage handlePaintingSelection={handlePaintingSelection} />
                        }
                    </main>
                    <Footer />
            </div>
        </>
    )
}

// Header and Footer components -
// structural components without processing or data.

function Header(){
    return(
        <header className="relative custom-header mb-8">

             <div className="absolute header-background overflow-hidden"
                  style={{ backgroundImage: `url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Artemisia_Gentileschi_-_Bathsheba_-_WGA08558.jpg/800px-Artemisia_Gentileschi_-_Bathsheba_-_WGA08558.jpg')`}}>
            </div>

            <div className="absolute inset-0 w-full h-full custom-header-border"></div>

            <div className="relative flex items-center px-2 py-2 text-4xl leading-9 font-medium text-gray-100 md:container md:mx-auto">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="40"
                height="40"
                viewBox="0 0 24 24"
                className="mr-2"
                style={{ fill: 'currentColor' }}
                >
                <path d="M13.4 2.096a10.08 10.08 0 0 0-8.937 3.331A10.054 10.054 0 0 0 2.096 13.4c.53 3.894 3.458 7.207 7.285 8.246a9.982 9.982 0 0 0 2.618.354l.142-.001a3.001 3.001 0 0 0 2.516-1.426 2.989 2.989 0 0 0 .153-2.879l-.199-.416a1.919 1.919 0 0 1 .094-1.912 2.004 2.004 0 0 1 2.576-.755l.412.197c.412.198.85.299 1.301.299A3.022 3.022 0 0 0 22 12.14a9.935 9.935 0 0 0-.353-2.76c-1.04-3.826-4.353-6.754-8.247-7.284zm5.158 10.909-.412-.197c-1.828-.878-4.07-.198-5.135 1.494-.738 1.176-.813 2.576-.204 3.842l.199.416a.983.983 0 0 1-.051.961.992.992 0 0 1-.844.479h-.112a8.061 8.061 0 0 1-2.095-.283c-3.063-.831-5.403-3.479-5.826-6.586-.321-2.355.352-4.623 1.893-6.389a8.002 8.002 0 0 1 7.16-2.664c3.107.423 5.755 2.764 6.586 5.826.198.73.293 1.474.282 2.207-.012.807-.845 1.183-1.441.894z"></path>
                <circle cx="7.5" cy="14.5" r="1.5"></circle>
                <circle cx="7.5" cy="10.5" r="1.5"></circle>
                <circle cx="10.5" cy="7.5" r="1.5"></circle>
                <circle cx="14.5" cy="7.5" r="1.5"></circle>
            </svg>
                <div>Painting Catalog</div>                          
            </div>
        </header>
    )
}

function Footer(){
    return(
        <footer className="custom-footer">
            <div className="py-2 text-gray-200 md:container md:mx-auto px-2">
                 <div>V. Cirša</div>
                 <div>Vea, 2025</div>
            </div>   
        </footer>
    )
}


// Homepage - loads data from API and displays top paintings
function Homepage({ handlePaintingSelection }) {
    const [topPaintings, setTopPaintings] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(function () {
        async function fetchTopPaintings() {
    
            try {
                setIsLoading(true);
                setError(null);
                const response = await fetch('http://localhost/data/get-top-paintings');
                
                if(!response.ok){
                    throw new Error("Error while loading data. Please reload page!");
                }

                const data = await response.json();
                console.log('top paintings fetched', data);
                setTopPaintings(data);
                } catch (error) {
                    setError(error.message);
                } finally {
                    setIsLoading(false);
                }
        }
        fetchTopPaintings();
    }, []);

    return (
        <>
            {isLoading && <Loader />}
            {error && <ErrorMessage msg={error}/>}
            {!isLoading && !error && (
                topPaintings.map((painting, index) => (
                    <TopPaintingView 
                        painting={painting}
                        key={painting.id}
                        index={index}
                        handlePaintingSelection={handlePaintingSelection} 
                     />
                ))
            )}
        </>
    )
}

// Painting page component- structural component that contains parts of the painting page
function PaintingPage({ selectedPaintingID, handlePaintingSelection, handleGoingBack }) {
    return (
        <>
            <SelectedPaintingView
                selectedPaintingID={selectedPaintingID}
                handleGoingBack={handleGoingBack}
            />
            <RelatedPaintingSection
                selectedPaintingID={selectedPaintingID}
                handlePaintingSelection={handlePaintingSelection}
            />
        </>
    )
}

// Top Painting View - displays paintings on Homepage
function TopPaintingView({ painting, index, handlePaintingSelection }) {
    console.log("Rendering painting:", painting);
    return (
        <div className="relative mb-8 py-8 flex flex-wrap md:flex-row overflow-hidden">
            
            <div className="absolute inset-0 w-full h-full bg-cover bg-center custom-background-container-homepage"
                style={{backgroundImage: `url(${painting.image})`,}}>
            </div>

            <div className="absolute inset-0 w-full h-full custom-border"></div>

            <div className={`order-2 px-12 md:basis-1/2 ${ index % 2 === 1 ? "md:order-1 md:text-right" : ""}`}>
                <p className="mb-4 text-3xl leading-9 font-medium text-gray-100 relative">
                    {painting.title}
                </p>

                <p className="mb-4 text-xl leading-7 font-normal text-gray-100 md:hidden relative">
                    { (painting.description.split(' ').slice(0, 16).join(' ')) + '...' }
                </p>

                <p className="mb-4 text-xl leading-7 font-normal text-gray-100 hidden md:block lg:hidden relative">
                    { (painting.description.split(' ').slice(0, 24).join(' ')) + '...' }
                </p>

                <p className="mb-4 text-xl leading-7 font-normal text-gray-100 hidden lg:block relative">
                    { (painting.description.split(' ').slice(0, 48).join(' ')) + '...' }
                </p>

                <div className="relative">
                    <SeeMoreBtn
                        paintingID={painting.id}
                        handlePaintingSelection={handlePaintingSelection}
                    />
                </div>   

            </div>
            <div className={`order-1 md:basis-1/2 ${ index % 2 === 1 ? "md:order-2" : ""}md:px-1 relative`}>          
                <img
                    src={ painting.image }
                    alt={ painting.title }
                    className="p-1 w-full md:w-[400px] h-full md:h-[400px] object-cover mx-auto shadow-md" 
                />
            </div>
        </div>
    )
}

// Selected Painting View - displays selected painting details
function SelectedPaintingView({ selectedPaintingID, handleGoingBack }) {
    const [selectedPainting, setSelectedPainting] = useState({});
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(function (){
        console.log("Fetching painting with ID:", selectedPaintingID);
        async function fetchSelectedPainting() {

            try {
                setIsLoading(true);
                setError(null);
                const response = await fetch('http://localhost/data/get-painting/' + selectedPaintingID);

                if(!response.ok) {
                    throw new Error("Error while loading data. Please reload page!");
                }

                const data = await response.json();
                console.log("Fetched painting data:", data);
                console.log('painting ' + selectedPaintingID + ' fetched', data);
                setSelectedPainting(data);
            } catch(error) {
                console.error("Error fetching painting:", error.message);
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }
        fetchSelectedPainting();
    }, [selectedPaintingID]);


    return (
        <>
            {isLoading && <Loader />}
            {error && <ErrorMessage msg={error} />}
            {!isLoading && !error && <>

        <div className="relative flex flex-wrap md:flex-row pb-10 overflow-hidden">

        <div className="absolute inset-0 w-full h-full bg-cover bg-center custom-background-container-selected-painting"
                style={{ backgroundImage: `linear-gradient(to right, rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.1)), url(${selectedPainting.image})`, }}></div>

        <div className="absolute inset-0 w-full h-full custom-border"></div>    

            <div className="relative order-2 md:order-1 md:pt-12 md:basis-1/2 md:px-12">
                <h1 className="relative text-3xl leading-9 font-semibold text-gray-100 mb-2">
                    {selectedPainting.title}
                </h1>
                <p className="relative text-2xl leading-7 font-medium text-gray-200 mb-2">
                    {selectedPainting.artist}
                </p>
                <p className="relative text-lg leading-7 font-light text-gray-100 mb-4">
                    {selectedPainting.description}
                </p>

                <dl className="relative mb-4 md:flex md:flex-wrap md:flex-row">
                    <div className="mb-2 md:basis-full">
                        <dt className="font-bold inline">Year: </dt>
                        <dd className="inline">{selectedPainting.year}</dd>
                    </div>
                    <div className="mb-2 md:basis-full">  
                        <dt className="font-bold inline">Style: </dt>
                        <dd className="inline">{selectedPainting.style}</dd>
                    </div>      
                    <div className="mb-2 md:basis-full">
                        <dt className="font-bold inline">Location: </dt>
                        <dd className="inline">{selectedPainting.location}</dd>
                    </div>
                </dl>
            </div>
        <div className="relative order-1 md:order-2 md:pt-12 md:px-12 md:basis-1/2 shadow-xs">
            <img
                src={selectedPainting.image}
                alt={selectedPainting.title}
                className="p-1 mx-auto" 
            />
        </div>
    </div>
    <div className="mb-12 flex flex-wrap pt-2">
        <GoBackBtn handleGoingBack={handleGoingBack} />
    </div>
    </>}
    </>
    )
}

// Related Painting Section
function RelatedPaintingSection({ selectedPaintingID, handlePaintingSelection }) {
    const [relatedPaintings, setRelatedPaintings] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(function (){
        async function fetchRelatedPainting() {
            try{
                setIsLoading(true);
                setError(null);
                const response = await fetch('http://localhost/data/get-related-paintings/' + selectedPaintingID);
                
                if (!response.ok) {
                    throw new Error("Error while loading related paintings. Please reload the page!");
                }

                const data = await response.json();
                console.log('related painting ' + selectedPaintingID + ' fetched', data);
                setRelatedPaintings(data);  
            } catch (error){
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }
        fetchRelatedPainting();        
    }, [selectedPaintingID]);


    return (
        <>
            {isLoading && <Loader />}
             {error && <ErrorMessage msg={error} />}
            {!isLoading && !error && <>
                
                <div className="flex flex-wrap">
                    <h2 className="mb-6 text-3xl leading-8 font-light text-gray-100">
                        Other Paintings:
                    </h2>
                </div>
                <div className="flex flex-wrap md:flex-row md:space-x-4 md:flex-nowrap">
                    {relatedPaintings.map( painting => (
                        <RelatedPaintingView
                            painting={painting}
                            key={painting.id}
                            handlePaintingSelection={handlePaintingSelection}
                        />
                    ))}
            </div>
            </>}
        </>
    )
}

// Related Painting View
function RelatedPaintingView({ painting, handlePaintingSelection }) {
    return (
        <div className="mb-4 mt-3 md:basis-1/3 group custom-hover-scale">
            <img
                src={ painting.image }
                alt={ painting.title }
                className="md:h-[440px] md:w-[390px] object-cover md:mx-auto max-md:w-2/4 max-md:mx-auto" 
            />
            <div className="p-4">
                <h3 className="text-lg leading-7 font-light text-gray-100 mb-4">
                    { painting.title }
                </h3>
                <SeeMoreBtn
                    paintingID={painting.id}
                    handlePaintingSelection={handlePaintingSelection}
                />
            </div>
         </div>
    )
}

// See More Button
function SeeMoreBtn({ paintingID, handlePaintingSelection }) {
    return (
        <button
            className="inline-block rounded-full py-2 px-4 text-white cursor-pointer custom-button-color"
            onClick={() => handlePaintingSelection(paintingID)}
        >
            See more
        </button>
    )
}

// Go Back Button
function GoBackBtn({ handleGoingBack }){
    return (
        <button className="inline-block rounded-full py-2 px-4 custom-goback-button text-white cursor-pointer"
            onClick={handleGoingBack}>
            Back
        </button>
    )    
}
    
// Loader and Error Message components
function Loader() {
    return (
        <div className="mt-5 mb-5 flex justify-center items-center md:container md:mx-auto clear-both">
            <div className="loader"></div> 
        </div>
    )
}

function ErrorMessage({ msg }) {
    return (
        <div className="md:container md:mx-auto bg-red-300 my-8 p-2">
            <p className="text-black">{ msg }</p>
        </div>
    )
}