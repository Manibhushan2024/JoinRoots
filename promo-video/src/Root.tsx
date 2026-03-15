import { AbsoluteFill, Composition } from 'remotion';
import { PromoVideo } from './PromoVideo';
import './index.css';

export const RemotionRoot: React.FC = () => {
  return (
    <>
      <Composition
        id="PromoVideo"
        component={PromoVideo}
        durationInFrames={600} // 20 seconds at 30 fps
        fps={30}
        width={1920}
        height={1080}
      />
    </>
  );
};
