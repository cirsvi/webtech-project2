import { useEffect, useState } from "react";
import '../css/loader.css';

// Main application component
export default function App(){
    const [selectedPaintingID,setSelectedPaintingID] = useState(null);

    // function to store Painting ID in state
    function handlePaintingSelection(paintingID) {
        setSelectedPaintingID(paintingID);
    }

    // function to clear Painting ID from state
    function handleGoingBack() {
        setSelectedPaintingID(null);
    }
    

    return (
        <>
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
        </>
    )
}

// Header and Footer components -
// structural components without processing or data.

function Header(){
    return(
        <header className="bg-green-500 mb-8 py-2 sticky top-0">    
        <div className="px-2 py-2 font-serif text-green-50 text-xl leading-6
                        md:container md:mx-auto">
                        Painting Catalog
        </div>
        </header>
    )
}

function Footer(){
    return(
        <footer className="bg-neutral-300 mt-8">
            <div className="py-8 md:container md:mx-auto px-2">
                V. Cirša
                Vea, 2005
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
    return (
        <div className="bg-neutral-100 rounded-lg mb-8 py-8 flex flex-wrap md:flex-row">
            <div className=
                {`order-2 px-12 md:basis-1/2
                     ${ index % 2 === 1 ? "md:order-1 md:text-right" : ""}
                `}
            >
                <p className="mb-4 text-3xl leading-8 font-light text-neutral-900">
                    {painting.title}
                </p>
                <p className="mb-4 text-xl leading-7 font-light text-neutral-900 mb-4">
                    { (painting.description.split(' ').slice(0, 16).join(' ')) + '...' }
                </p>
                <SeeMoreBtn
                    paintingID={painting.id}
                    handlePaintingSelection={handlePaintingSelection}
                />
            </div>
            <div className=
                {`order-1 md:basis-1/2 ${ index % 2 === 1 ? "md:order-2" : ""}`}
            >
                <img
                    src={ painting.image }
                    alt={ painting.title }
                    className="p-1 rounded-md border border-neutral-200 w-2/4 aspect-automx-auto" />
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
        async function fetchSelectedPainting() {

            try {
                setIsLoading(true);
                setError(null);
                const response = await fetch('http://localhost/data/get-painting/' + selectedPaintingID);

                if(!response.ok) {
                    throw new Error("Error while loading data. Please reload page!");
                }

                const data = await response.json();
                console.log('painting ' + selectedPaintingID + ' fetched', data);
                setSelectedPainting(data);
            } catch(error) {
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

         <div className="rounded-lg flex flex-wrap md:flex-row">
            <div className="order-2 md:order-1 md:pt-12 md:basis-1/2">
                <h1 className="text-3xl leading-8 font-light text-neutral-900 mb-2">
                    {selectedPainting.title}
                </h1>
                <p className="text-xl leading-7 font-light text-neutral-900 mb-2">
                    {selectedPainting.artist}
                </p>
                <p className="text-xl leading-7 font-light text-neutral-900 mb-4">
                    {selectedPainting.description}
                </p>
                <dl className="mb-4 md:flex md:flex-wrap md:flex-row">
                    <dd className="mb-2 md:basis-3/4">
                        {selectedPainting.year}
                    </dd>
                    <dt className="font-bold md:basis-1/4">
                        Style
                    </dt>
                    <dd className="mb-2 md:basis-3/4">
                        {selectedPainting.style}
                    </dd>
                    <dt className="font-bold md:basis-1/4">
                        Location
                    </dt>
                    <dd className="mb-2 md:basis-3/4">
                        {selectedPainting.location}
                    </dd>
                </dl>
            </div>
        <div className="order-1 md:order-2 md:pt-12 md:px-12 md:basis-1/2">
            <img
                src={selectedPainting.image}
                alt={selectedPainting.title}
                className="p-1 rounded-md border border-neutral-200 mx-auto" />
        </div>
    </div>
    <div className="mb-12 flex flex-wrap">
        <GoBackBtn handleGoingBack={handleGoingBack} />
    </div>
    </>}
    </>
    )
}

// Related Painting Section
function RelatedPaintingSection({ selectedPaintingID, handlePaintingSelection }) {
    const [relatedPainting, setRelatedPainting] = useState([]);
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
                setRelatedPainting(data);  
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
                    <h2 className="text-3xl leading-8 font-light text-neutral-900 mb4">
                        Similar Paintings
                    </h2>
                </div>
                <div className="flex flex-wrap md:flex-row md:space-x-4 md:flexnowrap">
                    {relatedPainting.map( painting => (
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
        <div className="rounded-lg mb-4 md:basis-1/3">
            <img
                src={ painting.image }
                alt={ painting.title }
                className="md:h-[400px] md:mx-auto max-md:w-2/4 max-md:mx-auto" />
            <div className="p-4">
                <h3 className="text-xl leading-7 font-light text-neutral-900 mb4">
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
            className="inline-block rounded-full py-2 px-4 bg-sky-500 hover:bgsky-400 text-sky-50 cursor-pointer"
            onClick={() => handlePaintingSelection(paintingID)}
        >
            See more
        </button>
    )
}

// Go Back Button
function GoBackBtn({ handleGoingBack }){
    return (
        <button className="inline-block rounded-full py-2 px-4 bg-neutral-500 hover:bg-neutral-400 text-neutral-50 cursor-pointer"
            onClick={handleGoingBack}>
            Back
        </button>
    )    
}
    
// Loader and Error Message components
function Loader() {
    return (
        <div className="my-12 px-2 md:container md:mx-auto text-center clear-both">
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