import { AbsoluteFill, interpolate, spring, useCurrentFrame, useVideoConfig, Sequence, Img } from 'remotion';

export const PromoVideo: React.FC = () => {
  const frame = useCurrentFrame();
  const { fps } = useVideoConfig();

  // Scene 1: Happy Kid + Branding
  const fade1 = interpolate(frame, [0, 15], [0, 1], { extrapolateRight: 'clamp' });
  const scale1 = interpolate(frame, [0, 120], [1, 1.1], { extrapolateRight: 'clamp' });
  
  // Scene 2: The Question
  const slide2 = spring({ frame: frame - 100, fps, config: { damping: 100 } });
  
  // Scene 3: Therapy images + text
  const fade3 = interpolate(frame, [220, 240], [0, 1], { extrapolateRight: 'clamp' });
  
  // Scene 4: Online worldwide + Address
  const slide4 = spring({ frame: frame - 340, fps, config: { damping: 12 } });

  // Scene 5: Outro
  const fade5 = interpolate(frame, [460, 480], [0, 1], { extrapolateRight: 'clamp' });

  return (
    <AbsoluteFill style={{ backgroundColor: '#1B2B25', color: 'white', fontFamily: 'sans-serif', overflow: 'hidden' }}>
      
      {/* Scene 1: 0 - 120 */}
      <Sequence from={0} durationInFrames={120}>
        <AbsoluteFill>
          <Img 
            src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=1920&q=80" 
            style={{ width: '100%', height: '100%', objectFit: 'cover', transform: `scale(${scale1})`, opacity: fade1 }} 
          />
          <AbsoluteFill style={{ background: 'rgba(27, 43, 37, 0.6)', justifyContent: 'center', alignItems: 'center' }}>
            <h1 style={{ fontSize: 130, fontWeight: 'bold', margin: 0, opacity: fade1 }}>
              <span style={{color: 'white'}}>Connect</span> <span style={{color: '#52B788'}}>Roots</span>
            </h1>
            <p style={{ fontSize: 50, marginTop: 20, color: '#A7DEBA', opacity: fade1 }}>
              Nurturing Every Child's Growth
            </p>
          </AbsoluteFill>
        </AbsoluteFill>
      </Sequence>

      {/* Scene 2: 100 - 240 */}
      <Sequence from={100} durationInFrames={140}>
        <AbsoluteFill style={{ backgroundColor: '#2D6A4F', justifyContent: 'center', alignItems: 'center', transform: `translateY(${(1-slide2) * 1080}px)` }}>
          <h2 style={{ fontSize: 100, fontWeight: 'bold', textAlign: 'center', lineHeight: 1.3 }}>
            Does your child need<br/>support to thrive?
          </h2>
          <div style={{display: 'flex', gap: 40, marginTop: 60}}>
             <span style={{ fontSize: 40, background: 'rgba(255,255,255,0.2)', padding: '20px 40px', borderRadius: 20 }}>Speech Therapy</span>
             <span style={{ fontSize: 40, background: 'rgba(255,255,255,0.2)', padding: '20px 40px', borderRadius: 20 }}>Counselling</span>
             <span style={{ fontSize: 40, background: 'rgba(255,255,255,0.2)', padding: '20px 40px', borderRadius: 20 }}>Special Education</span>
          </div>
        </AbsoluteFill>
      </Sequence>

      {/* Scene 3: 220 - 360 */}
      <Sequence from={220} durationInFrames={140}>
        <AbsoluteFill style={{ opacity: fade3 }}>
          <Img 
            src="https://images.unsplash.com/photo-1573497620053-ea5300f94f21?w=1920&q=80" 
            style={{ width: '100%', height: '100%', objectFit: 'cover' }} 
          />
          <AbsoluteFill style={{ background: 'linear-gradient(to right, #1B2B25 0%, transparent 100%)', justifyContent: 'center', paddingLeft: 100 }}>
             <h2 style={{ fontSize: 110, fontWeight: 'bold', margin: 0, color: 'white', maxWidth: 1000, lineHeight: 1.2 }}>
               Expert Child <br/><span style={{color: '#F4A261'}}>Specialists</span>
             </h2>
             <p style={{fontSize: 45, color: '#EAF5EE', marginTop: 30, maxWidth: 800}}>Personalized therapy that unlocks their true potential.</p>
          </AbsoluteFill>
        </AbsoluteFill>
      </Sequence>

      {/* Scene 4: 340 - 480 */}
      <Sequence from={340} durationInFrames={140}>
         <AbsoluteFill style={{ backgroundColor: '#F4A261', justifyContent: 'center', alignItems: 'center', transform: `scale(${slide4})` }}>
            <h2 style={{ fontSize: 110, fontWeight: 'bold', color: '#1B2B25', margin: 0 }}>
              Available Worldwide
            </h2>
            <p style={{fontSize: 60, color: 'white', marginTop: 30, textAlign: 'center', lineHeight: 1.3}}>
              Online Sessions &<br/>In-Clinic at Vikaspuri, Delhi
            </p>
            <p style={{fontSize: 40, color: '#1B2B25', marginTop: 60, fontWeight: 'bold'}}>
              UDYAM-DL-11-0152999
            </p>
         </AbsoluteFill>
      </Sequence>

      {/* Scene 5: 460 - 600 */}
      <Sequence from={460} durationInFrames={140}>
        <AbsoluteFill style={{ backgroundColor: '#1B2B25', justifyContent: 'center', alignItems: 'center', opacity: fade5 }}>
          <div style={{ width: 200, height: 200, background: 'linear-gradient(135deg, #2D6A4F, #52B788)', borderRadius: 40, display: 'flex', alignItems: 'center', justifyContent: 'center', marginBottom: 40 }}>
            <span style={{ fontSize: 100, color: 'white' }}>🌱</span>
          </div>
          <h1 style={{ fontSize: 120, fontWeight: 'bold', margin: 0 }}>Book Today</h1>
          <p style={{ fontSize: 60, marginTop: 20, color: '#F4A261', fontWeight: 'bold' }}>connectroots.com</p>
          <p style={{ fontSize: 40, marginTop: 40, color: 'white' }}>+91 93348 92585</p>
        </AbsoluteFill>
      </Sequence>

    </AbsoluteFill>
  );
};
